<?php

use Guzzle\Http\Client as GuzzleClient;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Pull extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'pull';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Running this command will pull information from ';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		// initial output
		$this->comment('Sentry Migration');

		// client setup
		$client = new GuzzleClient('https://sprint.ly');

		// retrieve products
		$products_request = $client->get('/api/products.json')->setAuth(Config::get('sprintly.email'), Config::get('sprintly.api_key'));
		$products_response = $products_request->send();

		// generate snapshots for all products
		foreach ($products_response->json() as $product_raw)
		{
			// grab or create product in local storage
			$product = Product::find($product_raw['id']);
			if ( ! $product->id )
			{
				$product = new Product;
				$product->id = $product_raw['id'];
				$product->name = $product_raw['name'];
				$product->save();
			}

			// product output
			$this->comment('Product: '.$product->name);

			// retrieve products
			$items_request = $client->get('/api/products/'.$product->id.'/items.json')->setAuth(Config::get('sprintly.email'), Config::get('sprintly.api_key'));
			$items_response = $items_request->send();

			// initialize snapshot
			$snapshot = new stdClass;
			$snapshot->psoduct_id =
			$snapshot->current = new stdClass;
			$snapshot->backlog = new stdClass;
			$snapshot->current->{'~'} = 0;
			$snapshot->current->S = 0;
			$snapshot->current->M = 0;
			$snapshot->current->L = 0;
			$snapshot->current->XL = 0;
			$snapshot->backlog->{'~'} = 0;
			$snapshot->backlog->S = 0;
			$snapshot->backlog->M = 0;
			$snapshot->backlog->L = 0;
			$snapshot->backlog->XL = 0;

			// calculate snapshot
			foreach($items_response->json() as $item)
			{
				// increment sizes
				$snapshot->{$item['score']}++;

				// set type
				if ($item['status'] == 'in-progress')
				{
					$snapshot->current->{$item['score']}++;
				}
				elseif ($item['status'] == 'backlog')
				{
					$snapshot->backlog->{$item['score']}++;
				}
			}

			// store snapshot
			$snap = new Snapshot;
			$snap->product_id = $product->id;
			$snap->{'current_~'} = $snapshot->current->{'~'};
			$snap->current_s = $snapshot->current->S;
			$snap->current_m = $snapshot->current->M;
			$snap->current_l = $snapshot->current->L;
			$snap->current_xl = $snapshot->current->XL;
			$snap->{'backlog_~'} = $snapshot->backlog->{'~'};
			$snap->backlog_s = $snapshot->backlog->S;
			$snap->backlog_m = $snapshot->backlog->M;
			$snap->backlog_l = $snapshot->backlog->L;
			$snap->backlog_xl = $snapshot->backlog->XL;
			$snap->save();

		}

	}

}