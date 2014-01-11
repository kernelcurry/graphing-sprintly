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
			if ( ! $product)
			{
				$product = new Product;
				$product->name = $product_raw['name'];
			}

			// product output
			$this->comment('Product: '.$product->name);

			// retrieve products
			$items_request = $client->get('/products/'.$product->id.'/items.json')->setAuth(Config::get('sprintly.email'), Config::get('sprintly.api_key'));
			$items_response = $items_request->send();

			// initialize snapshot
			$snapshot = new stdClass;
			$snapshot->psoduct_id =
			$snapshot->current = new stdClass;
			$snapshot->backlog = new stdClass;
			$snapshot->{'~'} = 0;
			$snapshot->S = 0;
			$snapshot->M = 0;
			$snapshot->L = 0;
			$snapshot->XL = 0;

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

			var_dump($snapshot);

		}

	}

}