<?php
namespace Hostnet\Component\AccessorGenerator\Generator;

use Doctrine\Common\Collections\Collection;
use Hostnet\Component\AccessorGenerator\Generator\fixtures\Actor;
use Hostnet\Component\AccessorGenerator\Generator\fixtures\Movie;

/**
 * @author Hidde Boomsma <hboomsma@hostnet.nl>
 */
class MovieTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException BadMethodCallException
     */
    public function testGetActorsToManyArguments()
    {
        $movie = new Movie();
        $movie->getActors(1);
    }

    public function testRemoveActorEmpty()
    {
        $actor = new Actor();
        $movie = new Movie();
        $this->assertEmpty($movie->getActors());
        $actor->removeMovie($movie);
        $this->assertEmpty($movie->getActors());
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testAddActorToManyArguments()
    {
        $actor = new Actor();
        $movie = new Movie();
        $movie->addActor($actor, 2);
    }

    public function testMovieAddActor()
    {
        $actor = new Actor();
        $movie = new Movie();
        $movie->addActor($actor);
        $this->assertSame($actor, $movie->getActors()->first());
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testActorRemoveMovieToManyArguments()
    {
        $actor = new Actor();
        $movie = new Movie();
        $movie->removeActor($actor, 2);
    }

    public function testMovieActor()
    {
        // Create object for many-to-many bi-directional association
        $actor = new Actor();
        $movie = new Movie();

        // The collection should be emptye
        $this->assertEmpty($movie->getActors());

        // The collection should subclass Collection
        $this->assertInstanceOf(Collection::class, $movie->getActors());

        // Add actor to movie and retrieve it again from the other side
        $actor->addMovie($movie);
        $this->assertSame($actor, $movie->getActors()->first());

        // Remove again
        $movie->removeActor($actor);
        $this->assertEmpty($actor->getMovies());

        // Retrieve empty collection and fill afterwards,
        // the previous received object should contain the
        // new values;
        $actors = $movie->getActors();
        $actor->addMovie($movie);
        $this->assertSame($actor, $actors->first());
    }
}
