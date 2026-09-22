<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title><?php echo $this->config->item('productName') ?> | Trend Analysis</title>

<style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
        display: none !important;
    }
</style>

<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="hastagCntrl">
    <div class="container-fluid container-padding">
        <div class="row align-items-center mb-3">
			<div class="col-12">
				<div class="feature-banner">
					<div class="row align-items-center justify-content-between g-0">
						<div class="col-auto feature-wrap">
							<h5 class="feature-title">Trend Analysis</h5>
							<p class="feature-subtitle mb-0">
								Search trending analysis from your keywords.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="table-wrapper table-wrapper-style-2">
            <div class="d-flex align-items-sm-end align-items-start flex-sm-row flex-column gap-3 mb-2">
                <div class="form-group flex-grow-1 w-100">
                    <label for="search" class="form-label">Enter Keyword</label>
                    <div class="input-with-icon left-icon">
                        <!-- <div class="icon">
                            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                        </div> -->
                        <input type="search" ng-model="keyword" class="form-control" placeholder="Enter Keyword" style="padding-left: 15px !important;">
                    </div>
                </div>
                <div style="width: 144px">
                    <select class="selectpicker" ng-model="type">
                        <option value="top trending">Top Trending</option>
                        <option value="recent media">Recent Media</option>
                    </select>
                </div>
                
                <div style="max-width: fit-content;">
                    <a href="javascript:void(0)" class=" btn btn-primary" ng-click="hastagsearch()">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.9558 9.19618C10.9558 9.15277 10.932 9.11269 10.8938 9.09173L7.60572 7.29346L5.80745 4.00541C5.76554 3.92907 5.64013 3.92907 5.59855 4.00541L3.80028 7.29346L0.512232 9.09173C0.474145 9.11269 0.450195 9.15277 0.450195 9.19618C0.450195 9.23959 0.473979 9.28017 0.512232 9.30113L3.80028 11.0999L5.59855 14.388C5.61951 14.426 5.65959 14.45 5.703 14.45C5.74641 14.45 5.78649 14.4262 5.80745 14.388L7.60572 11.0999L10.8938 9.30113C10.9325 9.28 10.9558 9.23959 10.9558 9.19618Z" fill="white"/>
                            <path d="M9.27509 3.57182L10.9838 4.5062L11.9175 6.21458C11.9321 6.24099 11.9599 6.2576 11.9903 6.2576C12.0207 6.2576 12.0485 6.24111 12.0631 6.21458L12.998 4.5062L14.7061 3.57182C14.7325 3.55729 14.7491 3.5295 14.7491 3.4994C14.7491 3.4693 14.7326 3.44151 14.7061 3.42698L12.998 2.49293L12.0631 0.784543C12.034 0.731037 11.9467 0.731613 11.9179 0.784543L10.9842 2.49293L9.27543 3.42698C9.24903 3.44151 9.23242 3.4693 9.23242 3.4994C9.23242 3.5295 9.24868 3.55717 9.27509 3.57182Z" fill="white"/>
                            <path d="M17.498 13.3947L15.1489 12.1101L13.8647 9.76048C13.8473 9.72887 13.814 9.70898 13.7775 9.70898C13.7411 9.70898 13.7078 9.72873 13.6904 9.76048L12.4054 12.1101L10.0554 13.3947C10.0238 13.4121 10.0039 13.4454 10.0039 13.4818C10.0039 13.5183 10.0237 13.5516 10.0554 13.569L12.4054 14.8544L13.6904 17.2036C13.7078 17.2352 13.7411 17.2551 13.7775 17.2551C13.814 17.2551 13.8473 17.2353 13.8647 17.2036L15.1489 14.8544L17.498 13.569C17.5297 13.5516 17.5495 13.5183 17.5495 13.4818C17.5495 13.4454 17.5297 13.4121 17.498 13.3947Z" fill="white"/>
                        </svg>
                        Search
                    </a>
                </div>
            </div>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Preview </th>
							<th>Caption</th>
							<th>Suggested Hashtags</th>
                            <th>Source Link</th>
                            <th>Like</th>
                            <th>Comment</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
    					<tr ng-repeat="item in hastagdata">
                            <td>
                                <div class="thumb">
                                    <img ng-src="{{item.media_url}}" width="60">
                                </div>
                            </td>
                        
                            <td>
                                <div class="title" style="cursor: pointer;" data-bs-toggle="tooltip"  data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="{{item.only_caption || 'No Caption'}}"  data-bs-original-title=""  title="">
                                    {{item.only_caption || 'No Caption'}}
                                </div>
                            </td>
                        
                            <td>
                                <div class="d-flex align-items-center gap-2 hash-tags-list">
                                    <div class="hashtag" ng-repeat="tag in item.hashtags">
                                        {{tag || 'No Hastag'}}
                                    </div>
                                </div>
                            </td>
                        
                            <td>
                                <a href="{{item.permalink}}" target="_blank" class="source-link">
                                    <i class="fa-solid fa-link"></i> View
                                </a>
                            </td>
                        
                            <td>
                                <span class="icon-size"><i class="fa-solid fa-heart text-danger" aria-hidden="true"></i></span>
                                 {{item.like_count}}
                            </td>
                        
                            <td>
                                <span class="icon-size"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 0C3.36469 0 0 3.36469 0 7.5C0 8.94187 0.404063 10.3266 1.17 11.52L0.03375 14.3569C-0.035625 14.5313 0.0046875 14.73 0.137812 14.8631C0.226875 14.9522 0.346875 15 0.46875 15C0.527813 15 0.585937 14.9887 0.643125 14.9662L3.48 13.83C4.67344 14.5959 6.05813 15 7.5 15C11.6353 15 15 11.6353 15 7.5C15 3.36469 11.6353 0 7.5 0ZM7.5 14.0625C6.16313 14.0625 4.88344 13.6669 3.80062 12.9178C3.72187 12.8625 3.62812 12.8344 3.53437 12.8344C3.47531 12.8344 3.41625 12.8456 3.36 12.8681L1.31063 13.6894L2.13187 11.64C2.19 11.4938 2.17125 11.3278 2.08219 11.1994C1.33312 10.1166 0.9375 8.83687 0.9375 7.5C0.9375 3.88125 3.88125 0.9375 7.5 0.9375C11.1187 0.9375 14.0625 3.88125 14.0625 7.5C14.0625 11.1187 11.1187 14.0625 7.5 14.0625Z" fill="#D6346E"></path>
                                    </svg>
                                </span>
                                 {{item.comments_count}}
                            </td>
                            <td>
								<div class="copy-tag" ng-click="copyHashtags(item.hashtags)">
                                    <i class="fa-solid fa-copy"></i>
                                    Copy Tags
                                </div>
							</td>
                        </tr>

						<!--<tr>-->
						<!--	<td>-->
						<!--		<div class="d-flex gap-2 align-items-center">-->
						<!--			<div class="thumb"></div>-->
						<!--		</div>-->
						<!--	</td>-->
      <!--                      <td>-->
      <!--                          <div class="title">“It is a long established fact that a reader.”</div>-->
      <!--                      </td>-->
						<!--	<td>-->
      <!--                          <div class="d-flex align-items-center gap-2">-->
      <!--                              <div class="hashtag">-->
      <!--                                  #Published-->
      <!--                              </div>-->
      <!--                              <div class="hashtag">-->
      <!--                                  #Blog-->
      <!--                              </div>-->
      <!--                              <div class="hashtag">-->
      <!--                                  #Travel-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                      </td>-->
						<!--	<td>-->
						<!--		<a href="javascript:void(0)" class="source-link">-->
      <!--                              <i class="fa-solid fa-link"></i> -->
      <!--                              Restaurant.com-->
      <!--                          </a>-->
						<!--	</td>-->
						<!--	<td>-->
						<!--		<span class="icon-size"><i class="fa-solid fa-heart text-danger" aria-hidden="true"></i></span>-->
						<!--		<span>12.8k</span>-->
						<!--	</td>-->
						<!--	<td>-->
						<!--		<span class="icon-size"><i class="fa-solid fa-comment-dots"></i></span>-->
						<!--		<span>10.8k</span>-->
						<!--	</td>-->
						<!--	<td>-->
						<!--		<div class="copy-tag">-->
      <!--                              <i class="fa-solid fa-copy"></i>-->
      <!--                              Copy Tags-->
      <!--                          </div>-->
						<!--	</td>-->
						<!--</tr>-->
                    <tr ng-if="!hastagdata || hastagdata.length === 0">
                        <td colspan="6" class="text-center"> No results found.</td>
                    </tr>
					</tbody>
				</table>
			</div>
		</div>
    </div>




<script>
// ========== ANGULAR APP ==========
var app = angular.module('MyApp', []);

// Directive for file input
app.directive("fileInput", function () {
    return {
        scope: { fileInput: '=', onFileSelect: '&' },
        link: function (scope, element) {
            element.bind("change", function (event) {
                var file = event.target.files[0];
                scope.$apply(function () {
                    scope.fileInput = file;
                    scope.onFileSelect({ file: file });
                });
            });
        }
    };
});

    app.controller('hastagCntrl', function($scope, $http) {

   
    $scope.keyword  = "";
    $scope.type     = "top trending";

   
        
        
    $scope.hastagsearch= function() {
        if(!$scope.keyword){
            toastr.error("Please Enter a Keyword First");
            return;
        }
        jsLoader(true);
          var queryStr = "<?php echo base_url('search-hastag')?>";
            $http({
                method: 'POST',
                url: queryStr,
                aync: false,
                 data: $.param({
                    'keyword': $scope.keyword,
                    'type': $scope.type,
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function(response) {
                console.log(response)
                jsLoader(false); 
                if (response.data.success) {
                $scope.hastagdata = response.data.hastag_media;
            
                $scope.hastagdata.forEach(function(item) {
                    var result = $scope.extractCaptionAndHashtags(item.caption);
                    item.only_caption = result.text;
                    item.hashtags = result.hashtags;
                });
        
                toastr.success(response.data.msg);
            } else {
                toastr.error(response.data.msg);
                }
        
            })
            .catch(function(err) {
                jsLoader(false); 
                console.error(err);
                toastr.error("Somthing went wrong!");
            });
        };
        
        $scope.extractCaptionAndHashtags = function(caption) {
            if (!caption) return { text: '', hashtags: [] };
        
            var hashtags = caption.match(/#[a-zA-Z0-9_]+/g) || [];
            var text = caption.replace(/#[a-zA-Z0-9_]+/g, '').trim();
        
            return {
                text: text,
                hashtags: hashtags
            };
        };

    $scope.copyHashtags = function(hashtags) {
        if (!hashtags || hashtags.length === 0) {
            toastr.error("No hashtags to copy");
            return;
        }
    
        // Array → string
        var text = hashtags.join(' '); // space separated
    
        navigator.clipboard.writeText(text).then(function() {
            toastr.success("Hashtags copied!");
        }).catch(function(err) {
            console.error(err);
            toastr.error("Failed to copy");
        });
    };

    
    });   
    
</script>

<script>
// Loader
function jsLoader(show) {
    $(".temp_js_loader").remove();
    if (show) {
        $("body").append(
            '<div class="temp_js_loader" style="background:rgba(200,200,200,0.34);width:100%;height:100%;position:fixed;top:0;left:0;z-index:9999;">' +
            '<img src="<?php echo $this->config->item('assetsPath');?>themes/default/img/loading-icon.gif" style="position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;">' +
            '</div>'
        );
    }
}
</script>
