# API examples #

 Version: 05.07.12 16:05:36

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBALZCiBhkS8Xh19UKZBZBeyHSzruHJ4uaU5AS3rIz2FpAnZAslxlYfywewRZBTjgytNXU1YVrPXN2vWQQaywJ92ytfUPxHAiP7Hz1pWZCuR"
    }

Response: 

    {
      "sessid":"o5m65l2m64jqi9pgpf81k5hn14",
      "user":{
        "ctime":1341493449,
        "fb_name":"foo",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004010804750",
        "fb_profile_utime":1340810718,
        "fb_timezone":"3",
        "fb_uid":"100004010804750",
        "id":1148,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yp\/r\/yDnr5YfbJCH.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yP\/r\/FdhqUFlRalU.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/y9\/r\/IB7NOFmPw2a.gif",
        "sex":"female",
        "utime":1341493449
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/712/create`

Request: 

    {
      "text":"hifova"
    }

Response: 

    {
      "day_id":null,
      "text":"hifova",
      "ctime":1341493460,
      "id":42
    }

## CurrentDay - Start ##

`POST {{host}}current_day/start`

Request: 

    {
      "title":"vuga",
      "description":"kanelayi",
      "time_offset":1341493468,
      "occupation":"rukubo",
      "age":7,
      "type":6
    }

Response: 

    {
      "id":713,
      "user_id":1156,
      "title":"vuga",
      "description":"kanelayi",
      "time_offset":"1341493468",
      "occupation":"rukubo",
      "age":"7",
      "type":"6",
      "likes_count":null,
      "ctime":1341493468,
      "utime":1341493468,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##

`POST {{host}}current_day`

Request: `empty`

Response: 

    {
      "id":714,
      "user_id":1157,
      "title":"cojewikubojuduruhuhinadi",
      "description":"luxiyafenaraxuguhiwadanudasicuzixuyuyadicoruruwulociwilusakocehugavaguperahebagitebiyimirujogorivenahajuhigesivituzojigujisifezusizurexuyafinubevuyalacotohubeyotusefigasisakomasehapexecagakawabilecojocuyisirewunegesemulubeyavehubipanineyarobacemopuruwogo",
      "time_offset":0,
      "occupation":"jisinazeligahudotawakige",
      "age":6,
      "type":5,
      "likes_count":0,
      "ctime":1341493468,
      "utime":1341493468,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##

`POST {{host}}current_day/moment_create`

Request: 

    {
      "description":"gadunuroyipodonuficoyojixojetarucoxosijiyujamuyokujepovikatadeceduwomakebolinefujigufakicasemolitekalopilubujexotapudunabekizudodixigibomarogiluruxoyiyuremifohedawerubawoxagezujurehiguxomakojiyawizuso",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":155,
      "day_id":716,
      "description":"gadunuroyipodonuficoyojixojetarucoxosijiyujamuyokujepovikatadeceduwomakebolinefujigufakicasemolitekalopilubujexotapudunabekizudodixigibomarogiluruxoyiyuremifohedawerubawoxagezujurehiguxomakojiyawizuso",
      "img_url":"\/media\/1159\/day\/716\/31fe56438055ce59084f3761a742c08259f7d582.png",
      "likes_count":null,
      "ctime":1341493473
    }

## CurrentDay - Finish ##

`POST {{host}}current_day/finish`

Request: `empty`

Response: 

    null

## Day - Item ##

`POST {{host}}days/718/item`

Request: `empty`

Response: 

    {
      "id":718,
      "user_id":1161,
      "title":"lanakexibuxejodozanodusa",
      "description":"buticibekibulalogituyepotatudibagotehorofonorujumawikebapocofaxiwisajetizecihimonedurazezayadopukecoroficefesocaxecikatedonelafolelacipawomikisetovawimudafifejisopojawayesewemiferutazudalepoxemiyorozibovubekanufedacehipugicoxumitibocopacujizivasujukuwoku",
      "time_offset":0,
      "occupation":"sodubinukiderovamipewefu",
      "age":7,
      "type":11,
      "likes_count":0,
      "ctime":1341493475,
      "utime":1341493475,
      "is_ended":0,
      "moments":[
        {
          "id":156,
          "day_id":718,
          "description":"description wujutugalimegonufitofaxodoyazevujatacufilovoherisefunamosivovimasadodegiyufegusufuvozejosajisonezocazeruhufirulutanomulayopi",
          "img_url":"",
          "likes_count":0,
          "ctime":1341493475
        },
        {
          "id":157,
          "day_id":718,
          "description":"description motewogekehodaxiralodenonaruyimigavaxugehibiruyeyezatiteregixobayodotecaxalibevutoyigosuzumuriyihajukebemiviwikiheyiyilumuta",
          "img_url":"",
          "likes_count":0,
          "ctime":1341493475
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/719;720;742/item`

Request: `empty`

Response: 

    {
      "719":{
        "id":719,
        "user_id":1163,
        "title":"beluduhiketibahoyavuzoca",
        "description":"wewebuyifosugafopocicakuvasosofiyaxuwonanabokeluwijusowiwidifebajucasigetebalibeyefibabunakomiwojuyalagakehusecorefohenukunuherohirotuxadayumalahiviwekefucihocihohunabojumuzuyemowezamaciregoyijelukinolunewiredinaragopucomahuhosogajofubuhogedomovomemifupi",
        "time_offset":0,
        "occupation":"suyalacihaxovalaxizavece",
        "age":3,
        "type":10,
        "likes_count":0,
        "ctime":1341493477,
        "utime":1341493477,
        "is_ended":0,
        "moments":[
          {
            "id":158,
            "day_id":719,
            "description":"description fisoyecujipuricoponewowoletopuxopinivilacubonajatuhirahamuwazovigezaxecukasugazuyenikopuvexocogezejuriwunixoputicebibohozama",
            "img_url":"",
            "likes_count":0,
            "ctime":1341493477
          }
        ]
      },
      "720":{
        "id":720,
        "user_id":1164,
        "title":"benenikuhejilexukesexari",
        "description":"cicojetofuhumahoxekorejivehopufolekonakobonitodocijotodizejikifutipetuyorifegebeveyibabumenuworihewafotugufifesunomitinawabowogayadawuyatalujaxuselexupobolujozesajixenijunozinovucoxokuhovilowawarojahocujagututusomapoxekedaluharogujetojulazawowesiciviwure",
        "time_offset":0,
        "occupation":"liyirujimiwokadodinawaso",
        "age":1,
        "type":3,
        "likes_count":0,
        "ctime":1341493477,
        "utime":1341493477,
        "is_ended":0,
        "moments":[
          {
            "id":159,
            "day_id":720,
            "description":"description kupeyudiniyafeguyejesinanakuxuteyenugohogavenuhihosubacihilakamemudorelupahafipifekekivoxaxejemojimuzuxicaretasuladunumiceri",
            "img_url":"",
            "likes_count":0,
            "ctime":1341493477
          }
        ]
      },
      "742":null
    }

## Day - CommentCreate ##

`POST {{host}}days/722/comment_create`

Request: 

    {
      "text":"lebibusibuyorohelucafaxocosavicewavuyihujaruwuhewekuneviyiroyoyovopodusibelufoduciyitofofukanexebibahorezadavecutalitoculizuvugugeziyovusubifahudohuhesowosomulofegazuzoyacaceyabebepocijoburinuwoyuvumoyivayofuyehixeyecubokinajizajivebihugixasasimovipuhulo"
    }

Response: 

    {
      "text":"lebibusibuyorohelucafaxocosavicewavuyihujaruwuhewekuneviyiroyoyovopodusibelufoduciyitofofukanexebibahorezadavecutalitoculizuvugugeziyovusubifahudohuhesowosomulofegazuzoyacaceyabebepocijoburinuwoyuvumoyivayofuyehixeyecubokinajizajivebihugixasasimovipuhulo",
      "day":{
        "id":722,
        "user_id":1168,
        "title":"vekunegemahodonigodiyata",
        "occupation":"dunezenuxadozapepesawawa",
        "age":4,
        "type":8,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341493481,
        "utime":1341493481,
        "cip":0
      },
      "user":{
        "id":1168,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBALZCiBhkS8Xh19UKZBZBeyHSzruHJ4uaU5AS3rIz2FpAnZAslxlYfywewRZBTjgytNXU1YVrPXN2vWQQaywJ92ytfUPxHAiP7Hz1pWZCuR",
        "ctime":1341493481,
        "utime":1341493481,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1168,
      "day_id":722,
      "ctime":1341493483,
      "utime":1341493483,
      "id":1
    }

## Day - ShareDay ##

`POST {{host}}days/723/share`

Request: `empty`

Response: 

    {
      "id":"100004010804750_111797142297312"
    }

## Day - Update ##

`POST {{host}}days/42/update`

Request: 

    {
      "tags":[
        "tag1",
        "tag2"
      ],
      "top_moment_id":111
    }

Response: 

    null

## Day - DeleteDay ##

`POST {{host}}days/724/delete`

Request: `empty`

Response: 

    null

## Day - GetFavouriteDays ##

`POST {{host}}days/favourites`

Request: `empty`

Response: 

    [
      {
        "id":725,
        "user_id":1173,
        "title":"jufihadacenacowelifejape",
        "description":"janiwemijurazacaluzexanijefujobovigozofenolivisekopevatakucosakisicoheyozehowuzerimeremafivuraheteyapuwifahucefowociyimacexokabamudavupucuyadawuvukomuvidohivepegojaruyovuxuyoxoreladapevutidexezakocekudevayowixepukafabutafonavuwugatelimedewumeyupaziboteje",
        "time_offset":0,
        "occupation":"desunubexocewucereminapi",
        "age":8,
        "type":6,
        "likes_count":0,
        "ctime":1341493492,
        "utime":1341493492,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##

`POST {{host}}/days/726/favourite`

Request: `empty`

Response: 

    null

## Day - RemoveFromFavourites ##

`POST {{host}}/days/727/unfavourite`

Request: `empty`

Response: 

    null

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: `empty`

Response: 

    [
      {
        "id":728,
        "user_id":1180,
        "title":"kekarifeyugifugimixahupa",
        "description":"zabavisunuxanizopixohahicazomicinanesegegahosekevebakelijifoyegikowazagadiyovebimapujajolilevoxamoditesuxisoxofevogavivebepoyixefawukivecixugahawifobuwafivaxomaseyavojugevihamamotirinobexuzeyoruvirahuhajibusimibabixaxoyucupovedekehologimuzujubenukirehodu",
        "time_offset":0,
        "occupation":"boyovozoledezosizixuxifi",
        "age":4,
        "type":7,
        "likes_count":0,
        "ctime":1341493497,
        "utime":1341493497,
        "is_ended":0
      },
      {
        "id":729,
        "user_id":1180,
        "title":"jozesulecacufudumefijipo",
        "description":"xetunujahufijilapipocedaxabebikutatebakeziyebemixagujeyenunilulacakafolakeleruzizelepenaharozawagadizipewatiyozuyefitoputesojitisuzokibanosimojibixodisutepawerififidatoyecibewaxovagixuwibovofugemepezirayomosemijoxarosokigilizuvidocowujetapamuwecibocigezo",
        "time_offset":0,
        "occupation":"rayizevuxapoyayigomenebi",
        "age":6,
        "type":11,
        "likes_count":0,
        "ctime":1341493497,
        "utime":1341493497,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":728
    }

Response: 

    [
      {
        "id":729,
        "user_id":1180,
        "title":"jozesulecacufudumefijipo",
        "description":"xetunujahufijilapipocedaxabebikutatebakeziyebemixagujeyenunilulacakafolakeleruzizelepenaharozawagadizipewatiyozuyefitoputesojitisuzokibanosimojibixodisutepawerififidatoyecibewaxovagixuwibovofugemepezirayomosemijoxarosokigilizuvidocowujetapamuwecibocigezo",
        "time_offset":0,
        "occupation":"rayizevuxapoyayigomenebi",
        "age":6,
        "type":11,
        "likes_count":0,
        "ctime":1341493497,
        "utime":1341493497,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":728,
      "to":729
    }

Response: 

    [
      
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: `empty`

Response: 

    [
      {
        "id":731,
        "user_id":1182,
        "title":"wohofakusedicesicacezato",
        "description":"vatalekahimijileguvuxikilagexujowatejajosocajihimalenovuxagowiloraxugepuzoyedaxigeyocovutatipagahadijolejesinicowupusexijozuvacajaroxazekosufosateyinuwulutebujezuzuzucepogonutecoromimuhefebipaliyemutavuvewimufanopapugocefohofabofotusigicolewuxezifadelexo",
        "time_offset":0,
        "occupation":"favuxizakidiwoyotegucuhi",
        "age":3,
        "type":6,
        "likes_count":0,
        "ctime":1341493499,
        "utime":1341493499,
        "is_ended":0
      },
      {
        "id":732,
        "user_id":1181,
        "title":"dojadonapisanivaremoxihi",
        "description":"watawoletofozezivubowukulagodakudabuvidifefaratebodutitaruxoyetakozafasekunabelabixociyonomibemizipanenudayajefexacusuratarojafenokazuzayugehipamocarojevudabejiboraridinewovexebulorozetamokuhenulamituxivoyoyupenacipupapuwujevopehegawuvorosabejatuyeyigoji",
        "time_offset":0,
        "occupation":"ketejomorojotisemucoguva",
        "age":2,
        "type":6,
        "likes_count":0,
        "ctime":1341493499,
        "utime":1341493499,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":731
    }

Response: 

    [
      {
        "id":732,
        "user_id":1181,
        "title":"dojadonapisanivaremoxihi",
        "description":"watawoletofozezivubowukulagodakudabuvidifefaratebodutitaruxoyetakozafasekunabelabixociyonomibemizipanenudayajefexacusuratarojafenokazuzayugehipamocarojevudabejiboraridinewovexebulorozetamokuhenulamituxivoyoyupenacipupapuwujevopehegawuvorosabejatuyeyigoji",
        "time_offset":0,
        "occupation":"ketejomorojotisemucoguva",
        "age":2,
        "type":6,
        "likes_count":0,
        "ctime":1341493499,
        "utime":1341493499,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":731,
      "to":732
    }

Response: 

    [
      
    ]

## Day - CurrentUserDays ##

`POST {{host}}days/my`

Request: `empty`

Response: 

    [
      {
        "id":734,
        "user_id":1183,
        "title":"zidosonowedarahejomapuwe",
        "description":"hegurejimurulufulaxebavirihatotazuwifadozopirohatalofefoviyifomapesomulipuxesahegodeyefotafutobezociniyamokayonakoneyozovanixiwugujokexubezuxicedomajisasasisikuloroyirusoxiduvepehutubecoxoferiyekutuwiroyosozeyefodecexuzagirawubizuyipujepeninogoyexoguwili",
        "time_offset":0,
        "occupation":"gepovobewewuxalazezulusu",
        "age":6,
        "type":9,
        "likes_count":0,
        "ctime":1341493502,
        "utime":1341493502,
        "is_ended":0
      },
      {
        "id":735,
        "user_id":1183,
        "title":"nujonayesamilekixewusuxi",
        "description":"rimasoxiherihipenoheranecayedecoviyihuzicodebonimuxaxikumehimejeyetecovahulepuwawofodiriwufehipetelozayecepojesacuweliwekupomaxalezimusihefiruvoviyacolitacedulihezohojixifikuganajiyozovaxubemericudenuxonepokayosumometeforocedafemogekopumubitohajoladiwogu",
        "time_offset":0,
        "occupation":"vumosiwuguwinojeyavofiju",
        "age":5,
        "type":3,
        "likes_count":0,
        "ctime":1341493502,
        "utime":1341493502,
        "is_ended":0
      }
    ]

## Moments - Update ##

`POST {{host}}moments/165/update`

Request: 

    {
      "description":"lupifaloyepenesihapivuxonikugiwokibipihisutefetimeyeduyoherivicayasipuzevomucakilewidogicuyujazedotopobekigitocayutasunowiralikigajovedawerizosurizekiceyojehozivehipesitezoborociyidurarulusekirozecorubinagasetitupexakecasinefinegabevigarujenafalagojewawe"
    }

Response: 

    {
      "id":165,
      "day_id":740,
      "description":"lupifaloyepenesihapivuxonikugiwokibipihisutefetimeyeduyoherivicayasipuzevomucakilewidogicuyujazedotopobekigitocayutasunowiralikigajovedawerizosurizekiceyojehozivehipesitezoborociyidurarulusekirozecorubinagasetitupexakecasinefinegabevigarujenafalagojewawe",
      "img_url":"",
      "likes_count":0,
      "ctime":1341493517
    }

## Moments - Delete ##

`POST {{host}}moments/166/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/167/comment`

Request: 

    {
      "text":"fonaladetumidohecabubozajirumabosivarukewuyumegilekixepavezegayupozerepifilosofawinoxaxojuzixumipirawerasasesumilafedazixuzowidixorozesojecufimopoyorudixagopefidodabuvefujelozukusaxunoyomidoyelakiyawabamiyilekakeyubusikufecikicesukobufujihotoyopunemucofa"
    }

Response: 

    {
      "text":"fonaladetumidohecabubozajirumabosivarukewuyumegilekixepavezegayupozerepifilosofawinoxaxojuzixumipirawerasasesumilafedazixuzowidixorozesojecufimopoyorudixagopefidodabuvefujelozukusaxunoyomidoyelakiyawabamiyilekakeyubusikufecikicesukobufujihotoyopunemucofa",
      "moment":{
        "id":167,
        "day_id":742,
        "image_ext":"",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341493520,
        "utime":1341493520,
        "cip":0
      },
      "user":{
        "id":1196,
        "fb_uid":"100004010804750",
        "fb_access_token":"AAAFnVo0zuqkBALZCiBhkS8Xh19UKZBZBeyHSzruHJ4uaU5AS3rIz2FpAnZAslxlYfywewRZBTjgytNXU1YVrPXN2vWQQaywJ92ytfUPxHAiP7Hz1pWZCuR",
        "ctime":1341493520,
        "utime":1341493520,
        "cip":0
      },
      "cip":2130706433,
      "user_id":1196,
      "moment_id":167,
      "ctime":1341493522,
      "utime":1341493522,
      "id":43
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "ctime":1341493522,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":null,
        "fb_uid":"100004036783679",
        "id":1198,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341493522
      }
    ]

## User - UserByIdDays ##

`POST {{host}}users/1199/days/`

Request: `empty`

Response: 

    [
      {
        "id":743,
        "user_id":1199,
        "title":"bokuwaxirisoroyumipagoju",
        "description":"gojateyabovaxagejehulosumatucovepalejekedamufogibinidagojunitetekaromucidipegowejeripucuwohiyuyedibimafisoxunocucohorenizobuvugumemukonaliyufavetaxeliwefuhuvixevegabogifajedapudigixayaxebovuyigaseyurabulacucelevejojezeyoguhibusuwebuhicelapuledocibawuvawa",
        "time_offset":0,
        "occupation":"sanumapuparulagecafuzone",
        "age":2,
        "type":11,
        "likes_count":0,
        "ctime":1341493525,
        "utime":1341493525,
        "is_ended":0
      },
      {
        "id":744,
        "user_id":1199,
        "title":"julesokusajudanowibojite",
        "description":"cucuwemafujolijigicesowijekuniwijumahugivicabipewonilebositewivalejofiducadapojiluzugarulefeyulegobihakekimugulotemulaxumadebitehorixuyemigogojuboyiyuhexetuyicafotasokaciwefaheyaruzufujutekokinasavajurafohiberocopemufadizifirusixagifihixetizodibomevowodu",
        "time_offset":0,
        "occupation":"fiwugiwekexonitadaxutihu",
        "age":2,
        "type":4,
        "likes_count":0,
        "ctime":1341493525,
        "utime":1341493525,
        "is_ended":0
      }
    ]

## User - Followers ##

`POST {{host}}users/followers`

Request: `empty`

Response: 

    [
      
    ]

## User - Followers ##

`POST {{host}}users/followers`

Request: `empty`

Response: 

    [
      {
        "ctime":1341493526,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":1202,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341493526
      }
    ]

## User - Following ##

`POST {{host}}users/following`

Request: `empty`

Response: 

    [
      
    ]

## User - Following ##

`POST {{host}}users/following`

Request: `empty`

Response: 

    [
      {
        "ctime":1341493529,
        "fb_name":"bar",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004036783679",
        "fb_profile_utime":1340810728,
        "fb_timezone":"0",
        "fb_uid":"100004036783679",
        "id":1204,
        "pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "sex":"male",
        "utime":1341493529
      }
    ]

## User - Follow ##

`POST {{host}}users/1206/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/1208/unfollow`

Request: `empty`

Response: 

    null

