<?php

namespace Tests\Unit;

use stdClass;
use Tests\CreatesApplication;
use Tests\TestCase;

class RootTestCase extends TestCase
{
    use CreatesApplication;

    public $responseData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->responseData = new stdClass;
        $this->responseData->attributionHTML = "<a href='http://marvel.com'>Data provided by Marvel. © 2020 MARVEL</a>";
        $this->responseData->attributionText = "Data provided by Marvel. © 2020 MARVEL";
        $this->responseData->code = 200;
        $this->responseData->copyright = "© 2020 MARVEL";
        $this->responseData->etag = "df4b8755a8b57e91637d34eafc03712874c1ca7d";
        $this->responseData->status = "Ok";
        $this->responseData->data = new stdClass;
        $this->responseData->data->count = 20;
        $this->responseData->data->limit = 20;
        $this->responseData->data->offset = 0;
        $this->responseData->data->total = 47211;

        $this->responseData->data->results = [];

        $resultsArray = [];
        $resultsArray['collectedIssues'] = [];
        $resultsArray['collections'] = [];
        $resultsArray['creators'] = new stdClass;
        $resultsArray['dates'] = [];
        $resultsArray['description'] = null;
        $resultsArray['diamondCode'] = "";
        $resultsArray['digitalId'] = 0;
        $resultsArray['ean'] = "";
        $resultsArray['events'] = new stdClass;
        $resultsArray['format'] = "";
        $resultsArray['id'] = 82967;
        $resultsArray['images'] = [];
        $resultsArray['isbn'] = "";
        $resultsArray['issn'] = "";
        $resultsArray['issueNumber'] = 0;
        $resultsArray['modified'] = "2019-11-07T08:46:15-0500";
        $resultsArray['pageCount'] = 112;
        $resultsArray['prices'] = [];
        $resultsArray['resourceURI'] = "http://gateway.marvel.com/v1/public/comics/82967";
        $resultsArray['series'] = new stdClass;
        $resultsArray['stories'] = new stdClass;
        $resultsArray['textObjects'] = [];
        $resultsArray['thumbnail'] = new stdClass;
        $resultsArray['title'] = "Marvel Previews (2017)";
        $resultsArray['upc'] = "75960608839302811";
        $resultsArray['urls'] = [];
        $resultsArray['variantDescription'] = "";

        $resultsArray['thumbnail']->path = 'http://i.annihil.us/u/prod/marvel/i/mg/b/40/image_not_available';
        $resultsArray['thumbnail']->extension = 'jpg';

        $this->responseData->data->results[] = $resultsArray;
    }
}
