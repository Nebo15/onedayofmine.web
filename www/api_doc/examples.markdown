# API examples #

 Version: 08.07.12 03:38:01

## Auth - IsLoggedIn ##

`POST {{host}}auth/is_logged_in`

Request: `empty`

Response: 

    false

## Auth - Login ##

`POST {{host}}auth/login/`

Request: 

    {
      "fb_access_token":"AAAFnVo0zuqkBAOJuCVR3BCZCMfynmTasMsRFR3toj8wZAWf2neoJlTxct9B0Ujw6zHdrHZBGBydMEMgIjYclhwYrZBFtSbXTfRWTXuT9U5b60BxZCrXTu"
    }

Response: 

    {
      "sessid":"8gj1gn5c17l06mfsc92ni7a8s3",
      "user":{
        "fb_uid":"100004093051334",
        "first_name":"foo",
        "last_name":"foo",
        "sex":"male",
        "timezone":"3",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":"1341686153",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "occupation":"",
        "current_location":"",
        "birthday":"1992-08-08",
        "ctime":1341707866,
        "utime":1341707866,
        "id":502
      }
    }

## Complaints - Create ##

`POST {{host}}/complaints/177/create`

Request: 

    {
      "text":"zoduyi"
    }

Response: 

    {
      "day_id":null,
      "text":"zoduyi",
      "ctime":1341707868,
      "id":5
    }

## CurrentDay - Start ##

`POST {{host}}current_day/start`

Request: 

    {
      "title":"tebi",
      "description":"cevamoto",
      "time_offset":1341707869,
      "occupation":"mivere",
      "age":3,
      "type":11
    }

Response: 

    {
      "id":178,
      "user_id":510,
      "title":"tebi",
      "description":"cevamoto",
      "time_offset":"1341707869",
      "occupation":"mivere",
      "age":"3",
      "type":"11",
      "likes_count":null,
      "ctime":1341707869,
      "utime":1341707869,
      "is_ended":0
    }

## CurrentDay - GetCurrentDay ##

`POST {{host}}current_day`

Request: `empty`

Response: 

    {
      "id":179,
      "user_id":511,
      "title":"karibusimurocajupacijiri",
      "description":"nomilisuturazasusoyemebarosibecidibidojusuzocopokiduwabivoyucakapitofapubiladawipukebexocurawujelabicikadugexaviyawumovimevekasofojejokipisipixipomakesupifunutopayuvehexuwilozakicosorefugorujazeconedijuworuvuhuturefofimujuzecacokebofumosetucixowanamuwuvu",
      "time_offset":0,
      "occupation":"meyacevinaxomujixedipaca",
      "age":6,
      "type":10,
      "likes_count":0,
      "ctime":1341707869,
      "utime":1341707869,
      "is_ended":0
    }

## CurrentDay - CreateMoment ##

`POST {{host}}current_day/moment_create`

Request: 

    {
      "description":"dubupexuputifeyuyegosokuzagatowuruwadocopudofasaluxanecilenacebofuwenubataxufizikusudokicutahovipovapogeyafarasabeyadetefijigayuvoyemasehumucayamuhodaxemevojomakinupefudotavohemiyopoyazosejamopunafoze",
      "image_name":"foo\/bar\/example.png",
      "image_content":"iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+\/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc\/YPAAAAAElFTkSuQmCC"
    }

Response: 

    {
      "id":60,
      "day_id":181,
      "description":"dubupexuputifeyuyegosokuzagatowuruwadocopudofasaluxanecilenacebofuwenubataxufizikusudokicutahovipovapogeyafarasabeyadetefijigayuvoyemasehumucayamuhodaxemevojomakinupefudotavohemiyopoyazosejamopunafoze",
      "img_url":"\/media\/513\/day\/181\/6b27b91a921aa0ddf66bfab8271d4973a880e6ab.png",
      "likes_count":null,
      "ctime":1341707870
    }

## CurrentDay - Finish ##

`POST {{host}}current_day/finish`

Request: `empty`

Response: 

    null

## Day - Item ##

`POST {{host}}days/183/item`

Request: `empty`

Response: 

    {
      "id":183,
      "user_id":515,
      "title":"goyinahasibipuvacosogipa",
      "description":"maxogipaverapewuwawijuxepufexojexedasojiyupigekakenodicojexayenumozajepefatinanujarimoduyazuhisofoxiyitapipapacufokolimepifubupapisixeriwapihojikodugofocepagahopuhikuyedirefuxirakuripoxawajayucakidesexeragirumarapewikorovirutajukucehohidujizusifibidogufu",
      "time_offset":0,
      "occupation":"riyolukafecacizodevicoxe",
      "age":3,
      "type":10,
      "likes_count":0,
      "ctime":1341707870,
      "utime":1341707870,
      "is_ended":0,
      "moments":[
        {
          "id":61,
          "day_id":183,
          "description":"description metelohujukuyenunutitafomabakaduludurevujawemehafupudopivosavubarabepoguyafejikilukitudinuseronexinijojevirazapezuxoxafiwuti",
          "img_url":"",
          "likes_count":0,
          "ctime":1341707870
        },
        {
          "id":62,
          "day_id":183,
          "description":"description halizazasipobowiyivunibalogetorawamudizozilajenetecetalavonikanegabemadinimuwacijaxafeguzomeyapabomiriyadibulanofiwetajowoco",
          "img_url":"",
          "likes_count":0,
          "ctime":1341707870
        }
      ]
    }

## Day - Item_Many ##

`POST {{host}}days/184;185;862/item`

Request: `empty`

Response: 

    {
      "184":{
        "id":184,
        "user_id":517,
        "title":"gusuximociwaderuwigawuha",
        "description":"bivisubizacakifosuzoyuwamubofetexivihudeyelesizenuziwuperibuzobufuliritivawituvetosipexexucurasuyahisucicuxotobilocabuguxesilehemixamupixikidecidanacozucolibowigororejisococajehujerejobogamapotemelowamuxicavebatolalixonetacijivojowonojiyayuforotacotoyitu",
        "time_offset":0,
        "occupation":"pupewewitedewupunefotafi",
        "age":1,
        "type":5,
        "likes_count":0,
        "ctime":1341707870,
        "utime":1341707870,
        "is_ended":0,
        "moments":[
          {
            "id":63,
            "day_id":184,
            "description":"description fexeyumahonoyaxexozapojugedaxusahihamohomokeyetobowolamonireneluwozelebubehusutosihatotejerusasitovaxocufevujinabufopuzuhivu",
            "img_url":"",
            "likes_count":0,
            "ctime":1341707870
          }
        ]
      },
      "185":{
        "id":185,
        "user_id":518,
        "title":"hamuvegokijowimapusojefu",
        "description":"zigejutezacigezofefesabeneyeyululogorucozadanazolacahamokebejigodinokiletinetiyaragucoricovidugelobujidacojodeyohapexewuxikupiguhevotusupapohiliraxigolahocukexorohepufayoxegetuhojijoronomubenozubitavoyoxayozegevicedoconayawuxunozehuyabuvucujunegobegimape",
        "time_offset":0,
        "occupation":"duhokanoxojizedetuvukamu",
        "age":4,
        "type":11,
        "likes_count":0,
        "ctime":1341707870,
        "utime":1341707870,
        "is_ended":0,
        "moments":[
          {
            "id":64,
            "day_id":185,
            "description":"description sajarixayufotovefeyixixolatazopowuwiloperocenupodijuzatigimefawuzolekasavokerubomesimixoyeyakobelisulewedanofimoyadipudijapo",
            "img_url":"",
            "likes_count":0,
            "ctime":1341707870
          }
        ]
      },
      "862":null
    }

## Day - CommentCreate ##

`POST {{host}}days/187/comment_create`

Request: 

    {
      "text":"liwozoyuvoxebocuhodewiwilinepubumuririkehetecofekeratiraxapidilimacarilutaguyifevonifarahamevuzebajomopeyubugaduzomavafajokapekokohuludesafujeyebilonovuhazunemubowipuwecafikatenadavuxacuyofepacirojiyimaxugifovevigopemizowiwuyireyitisihufiruvemabajinefewa"
    }

Response: 

    {
      "text":"liwozoyuvoxebocuhodewiwilinepubumuririkehetecofekeratiraxapidilimacarilutaguyifevonifarahamevuzebajomopeyubugaduzomavafajokapekokohuludesafujeyebilonovuhazunemubowipuwecafikatenadavuxacuyofepacirojiyimaxugifovevigopemizowiwuyireyitisihufiruvemabajinefewa",
      "day":{
        "id":187,
        "user_id":522,
        "title":"letajimovoduribifufuraga",
        "occupation":"jugirepisebudomuvejepeke",
        "age":7,
        "type":2,
        "is_ended":0,
        "time_offset":0,
        "likes_count":0,
        "is_deleted":0,
        "ctime":1341707871,
        "utime":1341707871,
        "cip":0
      },
      "user":{
        "id":522,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBAOJuCVR3BCZCMfynmTasMsRFR3toj8wZAWf2neoJlTxct9B0Ujw6zHdrHZBGBydMEMgIjYclhwYrZBFtSbXTfRWTXuT9U5b60BxZCrXTu",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":1341686153,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "occupation":"",
        "birthday":"1992-08-08",
        "sex":"male",
        "ctime":1341707871,
        "utime":1341707871,
        "cip":0
      },
      "cip":2130706433,
      "user_id":522,
      "day_id":187,
      "ctime":1341707871,
      "utime":1341707871,
      "id":10
    }

## Day - ShareDay ##

`POST {{host}}days/188/share`

Request: `empty`

Response: 

    {
      "id":"100004093051334_100866216726480"
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

`POST {{host}}days/189/delete`

Request: `empty`

Response: 

    null

## Day - GetFavouriteDays ##

`POST {{host}}days/favourites`

Request: `empty`

Response: 

    [
      {
        "id":190,
        "user_id":527,
        "title":"paxajojidumotorebobehivu",
        "description":"lecuzivamiwocogeyefogujudufufurogopagejovakuziduwerafuzewagadurenanomulebocukeyepihonebemekocuyofikojuyerakuheguwipetotaxawudopeguzivuxiyelanobecisufibanuzopiyonujevavolaxuwuhumutolotupopahiyukefaluwudowupawaditihimufabinujugizolunimemamediwudajizipazaze",
        "time_offset":0,
        "occupation":"baxokuruhojiluxecipipiki",
        "age":4,
        "type":7,
        "likes_count":0,
        "ctime":1341707873,
        "utime":1341707873,
        "is_ended":0
      }
    ]

## Day - AddToFavourites ##

`POST {{host}}/days/191/favourite`

Request: `empty`

Response: 

    null

## Day - RemoveFromFavourites ##

`POST {{host}}/days/192/unfavourite`

Request: `empty`

Response: 

    null

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: `empty`

Response: 

    [
      {
        "id":193,
        "user_id":534,
        "title":"kugafatedukukimikutugeho",
        "description":"piferejenozudetevuluyurayonikalusijewonegifewurovanoyawuwegamodahimabulemorepeyehibarubiferozowedehagolohabujufilavazumadawavohuyicagixirukuwinetehodoxewojohonafojifezocesuxadinehodayuwepaxahavonuwisuwevopujahititokixurocuwupetiwijovajebokegasutanizajaca",
        "time_offset":0,
        "occupation":"jaralatijogocekoyecojoge",
        "age":1,
        "type":9,
        "likes_count":0,
        "ctime":1341707874,
        "utime":1341707874,
        "is_ended":0
      },
      {
        "id":194,
        "user_id":534,
        "title":"peliyazifizasunipevubeto",
        "description":"basuzoviwumojukajutucogofifuzuwabixuhokanususabayozukesivukotevotovujacubotovovomosuzelogumucetoyitesodonumepebayoyuceregagekucemorapoxaremanigigakepapofucivayeyimihesutacerevumacafoxemuyebunujamokamahijuxasegolilevufofenofutomawufaniyerotulahulavivuwera",
        "time_offset":0,
        "occupation":"rocovucicajuboyexuzocuyu",
        "age":6,
        "type":6,
        "likes_count":0,
        "ctime":1341707874,
        "utime":1341707874,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":193
    }

Response: 

    [
      {
        "id":194,
        "user_id":534,
        "title":"peliyazifizasunipevubeto",
        "description":"basuzoviwumojukajutucogofifuzuwabixuhokanususabayozukesivukotevotovujacubotovovomosuzelogumucetoyitesodonumepebayoyuceregagekucemorapoxaremanigigakepapofucivayeyimihesutacerevumacafoxemuyebunujamokamahijuxasegolilevufofenofutomawufaniyerotulahulavivuwera",
        "time_offset":0,
        "occupation":"rocovucicajuboyexuzocuyu",
        "age":6,
        "type":6,
        "likes_count":0,
        "ctime":1341707874,
        "utime":1341707874,
        "is_ended":0
      }
    ]

## Day - GetFollowingUsersDays ##

`POST {{host}}days/following_users/`

Request: 

    {
      "from":193,
      "to":194
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
        "id":196,
        "user_id":536,
        "title":"lunixukekizakevofupozoda",
        "description":"yakimetofubowipitelimapokemawocovigetuyuxuropageposawewapegicefuwicijalabaxihaxutiyiwotebuwahuyalarocayafusiyihodaguyujuxacadahibuhabefeburukuridulavobowawucamabogayehuguyowidukibahawadocetijohiweyafazavusuvamogowaxusudimigozazudacajuyuvocemebekufaxemeto",
        "time_offset":0,
        "occupation":"bositomewawutafebovunuwe",
        "age":6,
        "type":10,
        "likes_count":0,
        "ctime":1341707875,
        "utime":1341707875,
        "is_ended":0
      },
      {
        "id":197,
        "user_id":535,
        "title":"yusizokowokasobatohojeno",
        "description":"wunoforanekicikeleforayajavecidulorihevuralorocafesujiwotozubasitebapuxezezocasehecixugopemijabamacayujufenejanoniginibarisurozavagoyisaxalekuwunahamedawocimarecubakofexilenedajedoteyibuzibiwaludunecexipivomacoxoxujuveloxexecadihazasipigapesicihemasuxido",
        "time_offset":0,
        "occupation":"niyimazewobanejebodilose",
        "age":8,
        "type":8,
        "likes_count":0,
        "ctime":1341707875,
        "utime":1341707875,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":196
    }

Response: 

    [
      {
        "id":197,
        "user_id":535,
        "title":"yusizokowokasobatohojeno",
        "description":"wunoforanekicikeleforayajavecidulorihevuralorocafesujiwotozubasitebapuxezezocasehecixugopemijabamacayujufenejanoniginibarisurozavagoyisaxalekuwunahamedawocimarecubakofexilenedajedoteyibuzibiwaludunecexipivomacoxoxujuveloxexecadihazasipigapesicihemasuxido",
        "time_offset":0,
        "occupation":"niyimazewobanejebodilose",
        "age":8,
        "type":8,
        "likes_count":0,
        "ctime":1341707875,
        "utime":1341707875,
        "is_ended":0
      }
    ]

## Day - GetNewDays ##

`POST {{host}}days/new/`

Request: 

    {
      "from":196,
      "to":197
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
        "id":199,
        "user_id":537,
        "title":"giwotuviwotojanoyixusuca",
        "description":"viyucufaxivedawutokukifedodekabatubovazopoxoyopomumulocikevokuxavuxicugorakiwudexodehexolokomexedowarawefevafujanikusenaxuyeforepimenemonesofutomapajahezarazelisuvafexonikonalugudicewanidiricelunicehixogivoluripoyetiwuzilavuwekuromihozakebuyosuzehugegoja",
        "time_offset":0,
        "occupation":"boyoxacigunademewopowuvu",
        "age":7,
        "type":9,
        "likes_count":0,
        "ctime":1341707875,
        "utime":1341707875,
        "is_ended":0
      },
      {
        "id":200,
        "user_id":537,
        "title":"catapulewekebuliyipogetu",
        "description":"fufufuxusoxatovozojafenariyotomupoyonorekijagatevajuluzaluranacatuxetimayofawukozopinilumadafacudufulozekamecuxanimabuzizamagibenahuwehekomirenavufoxahugozijawugawajahoxodiborupopiyuharerujixipopuvunonodiholupahixirixematetezedodolojihikolutolihacajikaxa",
        "time_offset":0,
        "occupation":"sonafonukidelolatadozosa",
        "age":7,
        "type":3,
        "likes_count":0,
        "ctime":1341707875,
        "utime":1341707875,
        "is_ended":0
      }
    ]

## Moments - Update ##

`POST {{host}}moments/70/update`

Request: 

    {
      "description":"tegejaxelalewedaxolicuxiregukahalikorecahikavifohofepaxakadogexoxelininubuyukamotozetumaboxeboxubekiwukuvesamawewunitusorizohumefuwuvawinitusifilocasoxehuxitewuhoxawopegejuxilefikugedidabulusomiseherinukelurohamihizirugavusemenopagacomiladofigifaxofawubi"
    }

Response: 

    {
      "id":70,
      "day_id":205,
      "description":"tegejaxelalewedaxolicuxiregukahalikorecahikavifohofepaxakadogexoxelininubuyukamotozetumaboxeboxubekiwukuvesamawewunitusorizohumefuwuvawinitusifilocasoxehuxitewuhoxawopegejuxilefikugedidabulusomiseherinukelurohamihizirugavusemenopagacomiladofigifaxofawubi",
      "img_url":"",
      "likes_count":0,
      "ctime":1341707877
    }

## Moments - Delete ##

`POST {{host}}moments/71/delete`

Request: `empty`

Response: 

    null

## Moments - Comment ##

`POST {{host}}moments/72/comment`

Request: 

    {
      "text":"wojaboniwojaziyepedidadepamuvojokotegexazecurajekisiruxawecozegezutegigevegijirobegofavukuregutewilazohozifecubafetehijokucovowifesayuzumahizepanemuwonativijocixotusovawarojeyunerefanutejazipufesuyizomonoxirixevalexaseforonoberusitageyasimiwepepikesixeje"
    }

Response: 

    {
      "text":"wojaboniwojaziyepedidadepamuvojokotegexazecurajekisiruxawecozegezutegigevegijirobegofavukuregutewilazohozifecubafetehijokucovowifesayuzumahizepanemuwonativijocixotusovawarojeyunerefanutejazipufesuyizomonoxirixevalexaseforonoberusitageyasimiwepepikesixeje",
      "moment":{
        "id":72,
        "day_id":207,
        "image_ext":"0",
        "fb_id":"",
        "likes_count":0,
        "ctime":1341707877,
        "utime":1341707877,
        "cip":0
      },
      "user":{
        "id":550,
        "first_name":"foo",
        "last_name":"foo",
        "fb_uid":"100004093051334",
        "fb_access_token":"AAAFnVo0zuqkBAOJuCVR3BCZCMfynmTasMsRFR3toj8wZAWf2neoJlTxct9B0Ujw6zHdrHZBGBydMEMgIjYclhwYrZBFtSbXTfRWTXuT9U5b60BxZCrXTu",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
        "fb_profile_utime":1341686153,
        "timezone":3,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "occupation":"",
        "birthday":"1992-08-08",
        "sex":"male",
        "ctime":1341707877,
        "utime":1341707877,
        "cip":0
      },
      "cip":2130706433,
      "user_id":550,
      "moment_id":72,
      "ctime":1341707878,
      "utime":1341707878,
      "id":18
    }

## My - Profile ##

`POST {{host}}/my/profile`

Request: `empty`

Response: 

    {
      "id":551,
      "first_name":"foo",
      "last_name":"foo",
      "fb_uid":"100004093051334",
      "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004093051334",
      "fb_profile_utime":1341686153,
      "timezone":3,
      "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
      "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
      "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
      "occupation":"",
      "birthday":"1992-08-08",
      "sex":"male",
      "ctime":1341707878,
      "utime":1341707878
    }

## Social - FacebookFiends ##

`POST {{host}}social/facebook_friends`

Request: `empty`

Response: 

    [
      {
        "id":553,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004087981387",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "occupation":"",
        "birthday":"1980-08-08",
        "sex":"male",
        "ctime":1341707878,
        "utime":1341707878,
        "user_info":{
          "fb_uid":"100004087981387",
          "first_name":"bar",
          "last_name":"bar",
          "sex":"male",
          "timezone":null,
          "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
          "fb_profile_utime":"1341683761",
          "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
          "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
          "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
          "occupation":"",
          "current_location":"",
          "birthday":"1980-08-08"
        }
      }
    ]

## User - UserByIdDays ##

`POST {{host}}users/554/days/`

Request: `empty`

Response: 

    [
      {
        "id":208,
        "user_id":554,
        "title":"kocopesoximipixunuludoli",
        "description":"cavidovepegeyoniziwajirimuviheneleviyixixatotekovataperajirisayalopegixapixewebolotadecitobewumesarunibacukufenoderepotelosevanidakoritojarimadokoxumogulufaboraxuwikiforogayetedojohinomowilirelivobunotovodibedexixececuvijiwoxipunapexeyuxuguhalanilikadoru",
        "time_offset":0,
        "occupation":"fozejedigeyovavadipisata",
        "age":8,
        "type":6,
        "likes_count":0,
        "ctime":1341707878,
        "utime":1341707878,
        "is_ended":0
      },
      {
        "id":209,
        "user_id":554,
        "title":"yuhinulecazadapanaheneru",
        "description":"lonopototizohayevotupadelecorajaxutinibezaxedurunetakumocilososisiyaxukuyecacoyobotemefitogikuyajugevidoxavuxopujejunikecisiminulocajayakodekofozinizutamenuyavewupabijefiriduhahonesejaruciyuyosixozecarosonuwutecerimegiwakoxagovazuhopukaxeyipayelimoyewezo",
        "time_offset":0,
        "occupation":"huvazukolivadedawumahove",
        "age":8,
        "type":3,
        "likes_count":0,
        "ctime":1341707878,
        "utime":1341707878,
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
        "id":557,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004087981387",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "occupation":"",
        "birthday":"1980-08-08",
        "sex":"male",
        "ctime":1341707878,
        "utime":1341707878
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
        "id":559,
        "first_name":"bar",
        "last_name":"bar",
        "fb_uid":"100004087981387",
        "fb_profile_url":"http:\/\/www.facebook.com\/profile.php?id=100004087981387",
        "fb_profile_utime":1341683761,
        "timezone":0,
        "fb_pic_big":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yL\/r\/HsTZSDw4avx.gif",
        "fb_pic_square":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v2\/yo\/r\/UlIqmHJn-SK.gif",
        "fb_pic_small":"http:\/\/profile.ak.fbcdn.net\/static-ak\/rsrc.php\/v1\/yi\/r\/odA9sNLrE86.jpg",
        "occupation":"",
        "birthday":"1980-08-08",
        "sex":"male",
        "ctime":1341707879,
        "utime":1341707879
      }
    ]

## User - Follow ##

`POST {{host}}users/561/follow`

Request: `empty`

Response: 

    null

## User - Unfollow ##

`POST {{host}}users/563/unfollow`

Request: `empty`

Response: 

    null

