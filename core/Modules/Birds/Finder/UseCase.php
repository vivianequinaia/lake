<?php

namespace App\Lake\Modules\Birds\Finder;

use App\Lake\Modules\Birds\Finder\Builders\Builder;
use App\Lake\Modules\Birds\Finder\Exceptions\CountDucksDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\CountDucksGateway;
use App\Lake\Modules\Birds\Finder\Responses\Errors\Response;
use App\Lake\Modules\Birds\Finder\Responses\ResponseInterface;
use App\Lake\Modules\Birds\Finder\Responses\Status;
use App\Lake\Modules\Birds\Finder\Rules\CountDucksRule;

final class UseCase
{
    private $countDucksGateway;
    private $response;

    public function __construct(CountDucksGateway $countDucksGateway)
    {
        $this->countDucksGateway = $countDucksGateway;
    }

    public function execute()
    {
        try {
            $this->response = (new Builder())
                ->withCountDucksRule(new CountDucksRule($this->countDucksGateway))
                ->build();
        } catch (CountDucksDatabaseException $exception) {
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
