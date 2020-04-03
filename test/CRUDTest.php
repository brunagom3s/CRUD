<?php
use PHPUnit\Framework\TestCase;

use App\Connection;
use App\CRUD;


 
final class CRUDTest extends TestCase
{   
    //CREATE TEST
    public function test_that_create_output_is_true()
    {   
        $name='FIFA';
        $category= 'sports';
        $price=25.00;
        
        $connection = CRUD::connect();
        $return = CRUD::create($name, $category, $price);
        
        $this->assertTrue($return);
    } 

    //READ TEST
    public function test_if_return_of_getAll_is_array()
    {
        $connection=CRUD::connect();
        $videogames = CRUD::getAll();
        
        $this->assertIsArray($videogames);
        $this->assertSame('Fortnite', $videogames[0]['name']);
    }

    public function test_if_it_reads_by_category()
    {
        $connection=CRUD::connect();
        $videogames = CRUD::getByCategory('shooter');

        $this->assertIsArray($videogames);
        $this->assertSame('shooter', $videogames[0]['category']);
        $this->assertSame('shooter', $videogames[1]['category']);
        $this->assertSame('shooter', $videogames[2]['category']);

    }
    
    public function test_I_get_expected_data_from_getAll()
    {
        $connection=CRUD::connect();
        $videogames = CRUD::getAll();
        print_r($videogames);
        
        $this->assertSame('Fortnite', $videogames[0]['name']);
        $this->assertSame('CoD', $videogames[1]['name']);
        $this->assertSame('FIFA', $videogames[2]['name']);
    }

    //UPDATE
    public function test_if_category_is_updated()
    {   
        $id = 10;
        $newCategory = 'RPG';
        $connection = CRUD::connect();
        
        CRUD::updateCategory($id, $newCategory);
        $updatedGames = CRUD::getAll();
        
        $this->assertSame($newCategory, $updatedGames[3]['category']);
    }

    public function test_if_price_is_updated()
    {   
        $id = 12;
        $newPrice = 9;
        $connection = CRUD::connect();
        
        CRUD::updatePrice($id, $newPrice);
        $updatedGames = CRUD::getAll();
        
        $this->assertEquals($newPrice, $updatedGames[5]['price']);
    }

    //DELETE

    public function test_if_it_deletes_a_game()
    {
        $id= 54;

        $numberOfRowsBefore = count(CRUD::getAll());
        CRUD::deleteGame($id);
        $numberOfRowsAfter = count(CRUD::getAll());
        
        $this->assertGreaterThan($numberOfRowsAfter, $numberOfRowsBefore);
        //$updatedGames = CRUD::getAll();

    }
}
