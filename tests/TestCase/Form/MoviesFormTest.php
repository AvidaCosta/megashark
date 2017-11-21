<?php
namespace App\Test\TestCase\Form;

use App\Form\MoviesForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\MoviesForm Test Case
 */
class MoviesFormTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Form\MoviesForm
     */
    public $Movies;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Movies = new MoviesForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Movies);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
