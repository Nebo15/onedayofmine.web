# API examples #

 Version: 05.07.12 21:49:26

## CurrentDay - Start ##

`POST {{host}}current_day/start`

Request: 

    {
      "title":"tasi",
      "description":"merefahe",
      "time_offset":1341514161,
      "occupation":"waxuci",
      "age":6,
      "type":3
    }

Response: 

    {
      "id":270,
      "user_id":511,
      "title":"tasi",
      "description":"merefahe",
      "time_offset":"1341514161",
      "occupation":"waxuci",
      "age":"6",
      "type":"3",
      "likes_count":null,
      "ctime":1341514161,
      "utime":1341514161,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##

`POST {{host}}current_day`

Request: `empty`

Response: 

    {
      "id":271,
      "user_id":512,
      "title":"konehehebisevusucofopege",
      "description":"melameyacuwezesujoxogodigedivapenagukacicuwacixidofemeyonadegonososayonarecoxudarekasevakumipuhetujosusehozarafemikaxahebowivawibafobuzepumadomigusazujuvapigebenazibuyiyevacerecekahobawopazojiwedugalalagilutifapiwomogatesatijujixoteyuvewixupilebubezomowe",
      "time_offset":0,
      "occupation":"vunoyomaferabeyofubijove",
      "age":1,
      "type":9,
      "likes_count":0,
      "ctime":1341514161,
      "utime":1341514161,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##

`POST {{host}}current_day/moment_create`

Request: 

    {
      "description":"suzulemukiyonobatihopanesuzuxujisemasuzanuwapugekizunifalabezeyopevejohurazeyanesigabikipetisogebanetugexapukacapehitozeboxojazeditujufefobiwaremuyanumiregumejitalabojaketamenugidojohubixitecihinedumi",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":90,
      "day_id":273,
      "description":"suzulemukiyonobatihopanesuzuxujisemasuzanuwapugekizunifalabezeyopevejohurazeyanesigabikipetisogebanetugexapukacapehitozeboxojazeditujufefobiwaremuyanumiregumejitalabojaketamenugidojohubixitecihinedumi",
      "img_url":"\/media\/514\/day\/273\/523444f21198cbedb3d4705a2da3a42c2f6324d8.png",
      "likes_count":null,
      "ctime":1341514165
    }

## CurrentDay - Finish ##

`POST {{host}}current_day/finish`

Request: `empty`

Response: 

    null

