<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class DeveloperTest extends TestCase
{
    private const BASE_URL = "api/developers";
    private const JSON_STRUCTURE = ['nome', 'sexo', 'idade', 'dt_nasc', 'hobby'];

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan("migrate:refresh");
        $this->artisan('db:seed', ['--class' => 'DeveloperTableSeeder']);
    }

    public function testShouldReturnAllDevelopers()
    {
        $this->get(static::BASE_URL, []);
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(['*' => static::JSON_STRUCTURE]);
    }

    public function testShouldSearchOneDeveloper()
    {
        $this->get(static::BASE_URL . "?idade=22", []);
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(['*' => static::JSON_STRUCTURE]);
    }

    public function testShouldSearchMultipleDevelopers()
    {
        $this->get(static::BASE_URL . "?sexo=M", []);
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(['*' => static::JSON_STRUCTURE]);
    }

    public function testShouldSearchNoneDeveloper()
    {
        $this->get(static::BASE_URL . "?idade=-2", []);
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }

    public function testShouldReturnDeveloper()
    {
        $this->get(static::BASE_URL . "/2", []);
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(static::JSON_STRUCTURE);
    }

    public function testShouldNotReturnDeveloper()
    {
        $this->get(static::BASE_URL . "/123456789", []);
        $this->seeStatusCode(Response::HTTP_BAD_REQUEST);
    }

    public function testShouldCreateDeveloper()
    {
        $parameters = [
            'nome' => 'Ricardo da Costa e Silva',
            'sexo' => 'M',
            'idade' => '30',
            'dt_nasc' => '1990-01-15',
            'hobby' => 'Assistir séries'
        ];
        $this->post(static::BASE_URL, $parameters, []);
        $this->seeStatusCode(Response::HTTP_CREATED);
        $this->seeJsonStructure(static::JSON_STRUCTURE);
    }

    public function testShouldNotCreateDeveloper()
    {
        $parameters = [
            'sexo' => 'M',
            'idade' => '30',
            'hobby' => 'Assistir séries'
        ];
        $this->post(static::BASE_URL, $parameters, []);
        $this->seeStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testShouldUpdateDeveloper()
    {
        $parameters = [
            'nome' => 'Rita Soares Almeida',
            'sexo' => 'F',
            'idade' => '25',
            'dt_nasc' => '1995-03-04',
            'hobby' => 'Comprar decorações para a casa'
        ];

        $this->put(static::BASE_URL . "/2", $parameters, []);
        $this->seeStatusCode(Response::HTTP_OK);
        $this->seeJsonStructure(static::JSON_STRUCTURE);
    }

    public function testShouldDeleteDeveloper()
    {
        $this->delete(static::BASE_URL . "/2", [], []);
        $this->seeStatusCode(Response::HTTP_NO_CONTENT);
    }
}
