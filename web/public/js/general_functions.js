//super global variables
var current_video_id = "";
var current_video_name = "";
var current_video_description = "";
var current_video_image = "";
var current_video_content = "";
var current_video_updateDate = "";
var current_video_amount_views = "";
var current_video_amount_comments = "";
var current_video_score = "";
var current_video_userId = "";
var current_video_userName = "";

// logIn session: 
var session_userId = 0;
var session_locationId = 0; // get this data
var session_userName = "_";
var session_userFirstgivenname = "_";
var session_userSecondgivenname = "_";
var session_userFirstfamilyname = "_";
var session_userSecondfamilyname = "_";
var session_userEmail = "_";
var session_userPassword = "_";
var session_userBiography = "_";
var session_amountFollowers = "_";
var session_amountInfluencers = "_";
var session_amountVideos = "_";
var session_amountSpecificLists = "_";

// EditVideo variables: // EditProfileBundle
var edit_video_id = "";
var edit_video_name = "";
var edit_video_description = "";
var edit_video_image = "";
var edit_video_content = "";
var edit_video_updateDate = "";
var edit_video_amount_views = "";
var edit_video_amount_comments = "";
var edit_video_score = "";
var edit_video_coin_score = "";
var edit_video_userId = "";
var edit_video_userName = "";


var current_specificlistId = "";
var current_specificListVideoId = "";
var current_videoPosition = "";

//previous and next video
var next_video_image = "";
var previous_video_image = "";

var kindOfList_1 = ""; // nothing, replay, editLyricsBundle, listBundle, dataminingBundle, dataminingResults, historyResults, dataminingResults
var listId_1 = "";
var videoOrderPosition_1 = "";
var before_videoOrderPosition_1 = "";

//screen
var total_screen_mode = "incomplete";

//replay
var replay_mode = "false";

//lyrics
var lyricsPosition = 0;


//delete next variable
var firstLineValue = 150;
var secondLineValue = 100;
var thirdLineValue = 50;
var fourthLineValue = 0;
var fifthLineValue = -50;
    
var d_estrofas = 0;
var e_palabras = 0;
    

var estrofaAmount = 40; // es la cantidad de estrofas
var palabraAmount = 40; // este valor varia segun la estrofa... 

var currentVideo_playing = setInterval(function() {
}, 1000);

currentVideo_playingWithFormat = setInterval(function() {
}, 1000);

var animatedLyrics_2 = setInterval(function() {
}, 1);

var currentProgressBar = setInterval(function() {
}, 1);

var replay = setInterval(function() {
}, 1000);

var asignarValores = setInterval(function() {
}, 4000);

var deslize_to_left_interval = setInterval(function() {
}, 1);

var deslize_to_right_interval = setInterval(function() {
}, 1);

var video_speed = 5;

var lyricsWord = new Array(estrofaAmount);
for (var i=0; i<lyricsWord.length; i++)
{
    lyricsWord[i] = new Array(palabraAmount);
    
    for (var j=0; j<lyricsWord[i].length; j++)
    {
        lyricsWord[i][j] = new Array(12);
    }
}

var videocommentId = "";// CommentVideoBundle
var videocommentContent = "";// CommentVideoBundle
var videocommentDate = "";// CommentVideoBundle
var videocommentUserId = "";// CommentVideoBundle
var videocommentUserName = "";// CommentVideoBundle
var videocommentVideoId = "";// CommentVideoBundle
var videocommentVideoAmountComments = "";// CommentVideoBundle

// en que bundles se aplica

var videoSize = 3; // HomeBundle->Resources->views->home->configuration->iconImage->videoSize.html.twig (just in case... "3" by default)
var displaceDivs = 1; // HomeBundle->Resources->views->home->configuration->iconImage->videoSize.html.twig (just in case... "2" by default)
var ConfigurationAreaSize = "3";
var mode = "visible";
var bgMode = "withBg";
var statusSpecificVideo = "par";
var repetitions = 0;
var modeContent = "dynamic";

var modeOptions_VideoBundle = "visible";


// PROPIEDADES DE LA VENTANA



var windowId = 0;
var windowVideospeed = 0;
var windowGeolocalization = "";
var windowVolume = 0;
var windowVideosize = 0;
var windowConfigurationareasize = 0;
var windowCurrentvideo = 0;
var windowCurrentlist = 0;
var windowReplay = 0;
var windowThemeconfigurationarea = 0; // 1: session_visible 0: session_invisible
var windowThemesessionarea = 0; // 1: session_visible 0: session_invisible
var windowThemepresentationarea = 0; // 1: smallest_video, 2: small_video, 3: big_video, 4: biggest_video
var windowThemecolor = 0; // 0: dark 1: light - HomeBundle->fontColorDivs.html.twig
var windowModecomments = 0; // 0: dinamic 1: static
var modestoreId = 0; // 2: searchList, 3: currentTopicList 
var modestoreId2 = 0; // 1: shoppingList, 4: storeList 
// graphic variables
var configurationArea_right = 540; // HomeBundle->close.html.twig
var configurationArea_width = 900; // HomeBundle->close.html.twig
var sessionArea_right = 180; // HomeBundle->close.html.twig
var sessionArea_width = 540; // HomeBundle->close.html.twig
var presentationArea_width = $(window).width() - 180; // HomeBundle->close.html.twig
var searchBar_width = 180;

var concurrenceStore = 0; // 0: same; 1: more
var refreshingStore = 0; // 0: stop; 1: keep






            
            


var comentVideoFrame_bottom = 0;

        // specificList (getSegmentId) - muchos pa un usuario: el usuario las crea y les pone el nombre que cree
        // ListBundle
        // dataminingList (getSegmentId) - muchos pa un usuario: se crean cuando el usuario hace las busqueda, y el nombre que queda, es el que se le haya asignado
        // DataminingBundle->index.html.twig
        // ArtistList
        // editLyrics
        // 
        // 
        // searchResults (getSegmentId) - 
        // historyList (getSegmentId) - 
        // datamining (getSegmentId) - DataminingBundle
        
        






        
function showVideo(
            videoId, 
            videoName, 
            videoDescription, 
            videoImage, 
            videoContent, 
            videoUpdateDate, 
            videoAmountViews, 
            videoAmountComments, 
            videoScore, 
            userId, 
            userName,
            kindOfList,
            listId,
            videoOrderPosition
        )
{
alert("change 3");
//    muted='true'
//    alert("change 1");
    var my_video = document.getElementById("my_video_environment");
    alert("change 2");
    my_video.innerHTML =
        "<video id='my_video' width='100%' muted='true' autoplay='true'>" +
        "<source src='files/" + userId + "/" + videoId + "/" + videoContent + "') }}' type='video/mp4'> " +
        "</video>";
    clearInterval(currentVideo_playing); // EditLyricsBundle
//    alert("change 4");
    clearInterval(currentVideo_playingWithFormat); // PlayBannerBundle
//    alert("change 5");
    clearInterval(animatedLyrics_2);
//    alert("change 6");
    clearInterval(currentProgressBar);
//    alert("change 7");
    clearInterval(asignarValores); // CommentVideoBundle
//    alert("change 8");
    clearInterval(deslize_to_left_interval);
//    alert("change 9");
    clearInterval(deslize_to_right_interval);
//    alert("change 10");



//    if (refreshingStore == 0)
//    {
////    var refreshingStore = 0; // 0: stop; 1: keep
//        // update every new video
//        $("#artistList-storeBundle").attr('results', 0); //storeBundle/views/sore/artist
//        $("#fansList-storeBundle").attr('results', 0); //storeBundle/views/sore/fans
//    } else if (refreshingStore == 1)
//    {
//        
//    }
//    
//    if (concurrenceStore == 0)
//    {
////    var concurrenceStore = 0; // 0: same; 1: more
//        // INNER
//        $("#artistList-storeBundle").attr('interactions', 0); //storeBundle/views/sore/artist
//        $("#fansList-storeBundle").attr('interactions', 0); //storeBundle/views/sore/fans
//    } else if (concurrenceStore == 1)
//    {
//        // DONT INNER
//    }
    
    e_palabras = 0; // contador de palabras para el karaoke
    d_estrofas = 0; // contador de palabras para el karaoke
//    alert("change 11");
    current_video_id = videoId;
    current_video_name = videoName;
    current_video_description = videoDescription;
    current_video_image = videoImage;
    current_video_content = videoContent;
    current_video_updateDate = videoUpdateDate;
    current_video_amount_views = videoAmountViews;
    current_video_amount_comments = videoAmountComments;
    current_video_score = videoScore;
    current_video_userId = userId;
    current_video_userName = userName;
//    alert("change 12");
    // drawStoreList(); // StoreBundle->videoList_environment.html.twig
//    alert("7");
    // increaseAmountViews_crud(); // SongBundle CRUD
//    alert("8");
     update_songInfo(); // SongBundle.js GUI
//    alert("9");
     playBannerProgress(); // PlayBannerBundle
//    alert("10");
    //get_video_lyric(); // ShowLyricsBundle - Karaoke
//    alert("11");
     showCurrentTime_withFormat(); // PlayBannerBundle
//    alert("12");
     changeVideoSpeed(); // PlayBannerBundle
//    alert("13");
     showDuration(); // PlayBannerBundle
//    alert("14");
     ArtistBundle(); // ArtistBundle
//    alert("15");
     animarComentarios(); // CommentVideoBundle
//     alert("16");
     //getArtistInfo(); // PaypalBundle

//    alert("16");

    // storeHistory(); // HistoryBundle ->storeHistory.html.twig

    getScoreVideo(); // VideoBundle->ScoreVideo.html.twig
    getPersonalScoreVideo(); // VideoBundle->ScoreVideo.html.twig

//    kindOfList_1 = kindOfList; 
//    listId_1 = listId;
    before_videoOrderPosition_1 = videoOrderPosition_1;
    videoOrderPosition_1 = videoOrderPosition;
//    alert("videoOrderPosition_1: "+ videoOrderPosition_1);
    drawCurrentList(kindOfList, listId); //HomeBundle -> currentList.html.twig
//    alert("el video se acab??... "+listId+" ... "+videoOrderPosition);
    $("#my_video").on('ended', function(){
//        alert("kindOfList: "+kindOfList+
//              "listId: "+listId+
//              "videoOrderPosition: "+videoOrderPosition);

        // loadList(); // ListBundle -> playList.html.twig
        showNextVideo();
        
    });
//    alert("cdsbjhcbdshj");
}



function highlightPortrait(videoId)
{
    document.getElementById(videoId).style.transitionProperty = "all";
    document.getElementById(videoId).style.transitionDuration = "0.4s";
    document.getElementById(videoId).style.opacity = 1;
}

function hidePortrait(videoId)
{
    document.getElementById(videoId).style.transitionProperty = "all";
    document.getElementById(videoId).style.transitionDuration = "0.4s";
    document.getElementById(videoId).style.opacity = 0.4;
}

    
function configureLyricswordTimeWithFormat(time) {
    var minutes = parseInt(time / 60, 10);
    var seconds = time % 60;
    var minutesString = "";
    var secondsString = "";

    if (minutes<=9)
    {
        minutesString = "0"+minutes;
    }
    else
    {
        minutesString = ""+minutes;
    }

    if (seconds<=9)
    {
        secondsString = "0"+seconds;
    }
    else
    {
        secondsString = ""+seconds;
    }

    var newValue = minutesString + ":" + secondsString.substring(0, 2);
    return newValue;
}

function showMessage_EmergentWindow(message)
{
        var respectlyFormId = document.getElementById("emergentWindow");

        respectlyFormId.style.width = "100%";
        respectlyFormId.style.height = "100%";
        respectlyFormId.style.opacity = "0.9";
        respectlyFormId.style.zIndex = "20";
        respectlyFormId.style.position = "absolute";
        respectlyFormId.style.color = "gray";
        respectlyFormId.style.backgroundColor = "white";
        respectlyFormId.style.overflowY = "scroll";
        
        respectlyFormId.innerHTML = 
        "<center>"+
        "<br><br><br><br><br><br>"+
        "<table width='300px' border='0'>"+
        
            "<tr>"+
                "<td colspan='2' align='right'>"+
                "<div id='close_EmergentWindow' style='cursor:pointer; background-color:red; padding:5px; opacity: 0.5; color: white; width:40px; height:30px;'><center>X</center></div>"+
                "</td>"+
            "</tr>"+

            "<tr>"+
                "<td>"+
                    "<br>"+message+"<br><br>"+
                "</td>"+
            "</tr>"+

            "<tr height='40px'>"+
                "<td colspan='2'>"+
                
                "<center>"+
                    "<div id='accept_EmergentWindow' style='cursor:pointer; background-color:#1ab7ea; padding:5px; opacity: 0.5; width:60px; height:30px;'>"+
                    "ACCEPT"+
                    "</div>"+
                "</center>"+

                
                "</td>"+
            "</tr>"+
            
        "</table>"+
        
        "</center>";
                
        $('#close_EmergentWindow').click(function () {
        var respectlyFormId = document.getElementById("emergentWindow");

            respectlyFormId.style.width = "100%";
            respectlyFormId.style.height = "100%";
            respectlyFormId.style.opacity = "0";
            respectlyFormId.style.zIndex = "1";
            respectlyFormId.style.position = "absolute";

            respectlyFormId.innerHTML = "";
        });
        
                
        $('#accept_EmergentWindow').click(function () {
        var respectlyFormId = document.getElementById("emergentWindow");

            respectlyFormId.style.width = "100%";
            respectlyFormId.style.height = "100%";
            respectlyFormId.style.opacity = "0";
            respectlyFormId.style.zIndex = "1";
            respectlyFormId.style.position = "absolute";

            respectlyFormId.innerHTML = "";
        });
        
}

function solo_numeros(e)
{
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase(); // me convierte a letra el respectivo c??digo: keyCode
    letras = " 1234567890";
    especiales = "8-37-38-46-164"; 
    // 8 retroceso, 
    // 37 flecha para la izquierda, 
    // 38 flecha para la derecha
    // 46 tecla para suprimir
    // 164 para la tecla ??

    teclado_especial = false;

    for(var i in especiales){
        if(key===especiales[i])
        {
            teclado_especial=true;
            break; // me rompe el ciclo for
        }
    }

    // si "teclado" se encuentra en "letras" va a ser 1
    // si "teclado" no se encuentra en "letras" se encuentra va a ser -1
    if(letras.indexOf(teclado)===-1 && !teclado_especial){
        return false; // no va a permitir el ingreso de ese valor
    }
}

function solo_letras(e)
{
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase(); // me convierte a letra el respectivo c??digo: keyCode
    letras = "abcdefghijklmn??opqrstuvwxyz";
    especiales = "8-37-38-46-164"; 
    // 8 retroceso, 
    // 37 flecha para la izquierda, 
    // 38 flecha para la derecha
    // 46 tecla para suprimir
    // 164 para la tecla ??

    teclado_especial = false;

    for(var i in especiales){
        if(key===especiales[i])
        {
            teclado_especial=true;
            break; // me rompe el ciclo for
        }
    }
    
    // si "teclado" se encuentra en "letras" va a ser 1
    // si "teclado" no se encuentra en "letras" se encuentra va a ser -1
    if(letras.indexOf(teclado)===-1 && !teclado_especial){
        return false; // no va a permitir el ingreso de ese valor
    }
}

function solo_letras_numeros(e)
{
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase(); // me convierte a letra el respectivo c??digo: keyCode
    letras = " 1234567890abcdefghijklmn??opqrstuvwxyz";
    especiales = "8-37-38-46-164"; 
    // 8 retroceso, 
    // 37 flecha para la izquierda, 
    // 38 flecha para la derecha
    // 46 tecla para suprimir
    // 164 para la tecla ??

    teclado_especial = false;

    for(var i in especiales){
        if(key===especiales[i])
        {
            teclado_especial=true;
            break; // me rompe el ciclo for
        }
    }

    // si "teclado" se encuentra en "letras" va a ser 1
    // si "teclado" no se encuentra en "letras" se encuentra va a ser -1
    if(letras.indexOf(teclado)===-1 && !teclado_especial){
        return false; // no va a permitir el ingreso de ese valor
    }
}