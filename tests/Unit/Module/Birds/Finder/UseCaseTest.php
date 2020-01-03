<?php

namespace Tests\Unit\Module\Birds\Finder;

use App\Lake\Modules\Birds\Finder\Entities\Bird;
use App\Lake\Modules\Birds\Finder\Exceptions\FindBirdsDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\FindBirdsGateway;
use App\Lake\Modules\Birds\Finder\Requests\Request;
use App\Lake\Modules\Birds\Finder\Responses\Response;
use App\Lake\Modules\Birds\Finder\Responses\Status;
use App\Lake\Modules\Birds\Finder\UseCase;
use App\Repositories\BirdRepository;

class UseCaseTest extends \PHPUnit\Framework\TestCase
{
    public function testYellowDuckSuccess()
    {
        $repositoryMock = new BirdRepository();
        $useCase = new UseCase($repositoryMock);
        $useCase->execute(RequestBoot::getRequestWithColor());

        $expectedResponse = new Response(
            StatusBoot::getSuccessStatus(),
            BirdBoot::getYellowDuckQuantity()
        );

        $this->assertEquals($expectedResponse, $useCase->getResponse());
    }

    public function testIsNotADuckSuccess()
    {
        $repositoryMock = new BirdRepository();
        $useCase = new UseCase($repositoryMock);
        $useCase->execute(RequestBoot::getEmptyRequest());

        $expectedResponse = new Response(
            StatusBoot::getSuccessStatus(),
            BirdBoot::getIsNotADuckQuantity()
        );

        $this->assertEquals($expectedResponse, $useCase->getResponse());
    }

    public function testFindBirdsDatabaseException()
    {
        $repositoryMock = $this->createMock(FindBirdsGateway::class);
        $repositoryMock->expects($this->exactly(1))->method('findBirds')->willThrowException(new FindBirdsDatabaseException());
        $useCase = new UseCase($repositoryMock);
        $useCase->execute(RequestBoot::getEmptyRequest());

        $expectedResponse = new \App\Lake\Modules\Birds\Finder\Responses\Errors\Response(
            StatusBoot::getFailureStatus(),
            'An error occurred while search for birds.'
        );

        $this->assertEquals($expectedResponse, $useCase->getResponse());
    }
}

Class RequestBoot
{
    public static function getEmptyRequest()
    {
        return new Request();
    }

    public static function getRequestWithColor()
    {
        return new Request('yellow');
    }
}

Class StatusBoot
{
    public static function getSuccessStatus(): Status
    {
        return new Status(200, 'Ok');
    }

    public static function getFailureStatus(): Status
    {
        return new Status(500, 'Internal Server Error');
    }
}

Class BirdBoot
{
    public static function getYellowDuckQuantity(): Bird
    {
        return new Bird(2);
    }

    public static function getIsNotADuckQuantity(): Bird
    {
        return new Bird(3);
    }
}
