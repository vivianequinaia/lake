<?php

namespace App\Lake\Modules\Birds\Finder;

use App\Lake\Modules\Birds\Finder\Builders\Builder;
use App\Lake\Modules\Birds\Finder\Exceptions\FindBirdsDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\FindBirdsGateway;
use App\Lake\Modules\Birds\Finder\Requests\Request;
use App\Lake\Modules\Birds\Finder\Responses\Errors\Response;
use App\Lake\Modules\Birds\Finder\Responses\ResponseInterface;
use App\Lake\Modules\Birds\Finder\Responses\Status;
use App\Lake\Modules\Birds\Finder\Rules\FindBirdsRule;

final class UseCase
{
    private $findBirdsGateway;
    private $response;

    public function __construct(FindBirdsGateway $findBirdsGateway)
    {
        $this->findBirdsGateway = $findBirdsGateway;
    }

    public function execute(Request $request)
    {
        try {
            $this->response = (new Builder())
                ->withFindBirdsRule(new FindBirdsRule($this->findBirdsGateway, $request))
                ->build();
        } catch (FindBirdsDatabaseException $exception) {
            $this->response = new Response(
                new Status(500, 'Internal Server Error'),
                'An error occurred while search for birds.'
            );
        } catch (\Exception $exception) {
            $this->response = new Response(
                new Status(500, 'Internal Server Error'),
                'Generic Error.'
            );
        }
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
