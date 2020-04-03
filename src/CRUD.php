<?php
namespace App;
use App\Connection;

class CRUD extends Connection
{   
    //CREATE
    public static function create(string $name, string $category, float $price) :bool
    {   

        $query = "INSERT INTO videogames (`name`, category, price) VALUES ('$name', '$category', '$price')";
        $response = mysqli_query(self::$connection, $query); 

        if($response == false)
        {
            return false;
        }
        return true;
    }

    //READ
    public static function getAll() :array
    {
        $query = "SELECT * FROM videogames";
        $response = mysqli_query(self::$connection, $query);
        
        $videogames = [];
        while ($game = mysqli_fetch_assoc($response))
        {
            array_push($videogames, $game);
        }
        return $videogames;  
    }
    
    public static function getByCategory(string $category) 
    {   
        $query = "SELECT * FROM videogames WHERE category = '$category'";
        $response = mysqli_query(self::$connection, $query);
        
        $videogames = [];
        while ($game = mysqli_fetch_assoc($response))
        {
            array_push($videogames, $game);
        }
        return $videogames;  
    }
   

    //UPDATE
    public static function updateCategory(int $id, string $newCategory)
    {
        $query = " UPDATE videogames SET category='$newCategory' WHERE id = '$id' ";
        $response = mysqli_query(self::$connection, $query);
    }

    public static function updatePrice (int $id, float $newPrice)
    { 
        $query = " UPDATE videogames SET price='$newPrice' WHERE id ='$id' ";
        $response = mysqli_query(self::$connection, $query);
    }

    //DELETE

    public static function deleteGame (int $id)
    { 
        $query = " DELETE FROM videogames WHERE id ='$id' ";
        $response = mysqli_query(self::$connection, $query);
    }


}