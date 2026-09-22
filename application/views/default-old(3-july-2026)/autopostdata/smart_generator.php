<style>
/* ===== LAYOUT FIX ===== */

/* remove extra shift */
.container-wrapper.container-open {
    margin-left: 0 !important;
}

/* center content properly */
.container-fluid.container-padding {
    display: flex;
    justify-content: center;
}

/* MAIN CENTER BOX */
.container-ai {
    width: 100%;
    max-width: 900px;
    margin-top: 60px;
    text-align: center;
    color: #eaeaea;
}

/* HEADER ALIGN CENTER WIDTH */
.header {
    max-width: 900px;
    margin: auto;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* TITLES */
.container-ai h1 {
    font-size: 52px;
    margin: 10px 0;
}

.container-ai h2 {
    letter-spacing: 2px;
    opacity: 0.7;
}

.subtitle {
    opacity: 0.6;
    margin-bottom: 30px;
}

/* COMMAND BOX FIX */
.command-box {
    width: 100%;
    max-width: 700px;
    margin: 30px auto;
    background: linear-gradient(145deg, #1e1e4a, #111130);
    padding: 15px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    box-shadow: 0 0 40px rgba(0, 150, 255, 0.25);
}

/* MIC */
.mic {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: radial-gradient(circle, #ff7a00, #ff3d00);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 22px;
    margin-right: 12px;
    cursor: pointer;
    transition: 0.3s;
}

.mic:hover {
    transform: scale(1.1);
    box-shadow: 0 0 20px #ff7a00;
}

/* INPUT */
.command-input {
    flex: 1;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 15px;
    outline: none;
}

/* BUTTON */
.process-btn {
    background: linear-gradient(90deg, #5f9cff, #00d4ff);
    border: none;
    padding: 10px 22px;
    border-radius: 25px;
    color: #fff;
    cursor: pointer;
}

/* STATUS CENTER */
.status {
    margin: 20px auto;
    display: inline-block;
    padding: 10px 20px;
    border-radius: 15px;
    background: rgba(255,255,255,0.05);
}

.status span {
    color: #00ff9c;
}

/* SOCIAL TAGS */
.socials {
    margin-top: 30px;
}

.tag {
    display: inline-block;
    padding: 8px 15px;
    border-radius: 20px;
    margin: 5px;
    background: rgba(255,255,255,0.08);
}

.green {
    color: #00ff9c;
}

/* HELP BTN */
.help {
    position: fixed;
    right: 20px;
    bottom: 20px;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #222;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="smartController">

    <div class="container-fluid container-padding">

        <div style="width:100%;">
            <div class="container-ai">
                <h2>WELCOME, COMMANDER!</h2>
                <h1>Greet Your Social Agent</h1>

                <div class="subtitle">
                    Start a Conversation. Give a Text or Voice Command to Begin.
                </div>

                <div class="command-box">
                    <div class="mic">🎤</div>

                    <input class="command-input" ng-model="commandText" placeholder="Hey Social Agent, post 5 viral reels on Instagram...">

                    <button class="process-btn" ng-click="generatePost()">
                        PROCESS →
                    </button>
                </div>

                <div class="status">
                    Social Agent Status: <span>{{status}}</span>
                </div>

                <div class="socials">
                    <div class="tag">YouTube <span class="green">(Green)</span></div>
                    <div class="tag">Instagram <span class="green">(Green)</span></div>
                    <div class="tag">Facebook <span class="green">(Green)</span></div>
                </div>
            </div>

        </div>

    </div>
    
    
<script>
     var baseUrl = '<?= base_url() ?>';

    var app = angular.module("AppModule", []);
    
    
    app.controller("smartController", function ($scope, $http, $timeout, $sce) {
        $scope.commandText == ""
        
       $scope.generatePost = function(){
            if ($scope.commandText == "") {
                    flashNow({
                        error: { message: "Please select a image." }
                    });
                    return
            }
            
            jsAvatarLoader(true);
            var queryStr = "<?php echo base_url('post-generator')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    aync: false,
                     data: {
                        'prompt' : $scope.commandText,
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function (response) {
                    console.log(response);
                    jsLoader(false);
                
                    if (response.data.success) {
                        toastr.success(response.data.message);
                    } else {
                        toastr.error(response.data.message || "Something went wrong");
                    }
                });

        }
        
         $scope.startGeneratingVideos = function() {
            $scope.avatardata.avatarListingMade.forEach(function(avatar) {
                if (avatar.avatar_id) {
              
                    $scope.getGeneratevAvtarVideoById(avatar.id,avatar.avatar_id,avatar.url,avatar.avatar_type);
                }
            });
        };
        
        
        
    });
</script>    


