<style>
   .question-sidebar{
        background: var(--rgba-primary-1);
        border-radius: 5px;
        padding: 15px 0;
        min-height: 650px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
   }
   .questions-list{
        list-style: none;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 10px;
        padding: 0;
   }
    .questions-list li a {
        padding: 10px;
        border: 1px solid rgba(1, 1, 1, 0.15);
        border-radius: 5px;
        display: block;
        transition: 0.4s;
        color: var(--theme-text-color);
    }
    .questions-list li a:hover{
        background: var(--primary-color);
        color: var(--text-primary);
        border-color: transparent;
    }
    .questions-list li a.add-more-question{
        font-weight: 600;
        color: var(--primary-color);
        background: transparent !important;
        border-style: dashed;
        border-color: var(--primary-color);
    }
    .question-box .form-control{
        border-color: var(--theme-br3) !important;
        padding: 10px 15px  !important;
    }
    .ending-sec-card label,
    .question-box label{
        color: var(--white-color);
        font-size: 14px;
        font-weight: 500;
        padding-left: 0 !important;
        margin-bottom: 10px;
    }
    @media (min-width: 1200px) {
        .question-box{
            padding: 50px 90px;
        }
    }
    .question-id{
        background: rgba(1, 1, 1, 0.07);
        border-radius: 5px;
        border: 1px solid var(--theme-br3);
    }
    .question-id .form-control{
        border: 0 !important;
    }
    .ending-sec-card{
        padding: 15px 20px;
        border: 1px solid var(--theme-br);
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        background: var(--theme-bg2);
        flex-direction: column;
    }
    .ending-sec-card.active{
        background: var(--rgba-primary-1);
        border-color: var(--primary-color);
    }
    .template-box .media{
        width: 100%;
    height: 150px;
    border-radius: 5px;
    border: 1px solid var(--theme-br3);
    overflow: hidden;
    margin-bottom: 10px;
    cursor: pointer;
    transition: 0.4s;
    }
    .template-box .content{
        color: var(--white-color);
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .template-box .selected-btn{
        padding: 2px 15px;
        border-radius: 50px;
        background: var(--primary-color);
        color: var(--text-primary);  
        scale: 0.8;
        opacity: 0;
        transition: 0.4s;
     }
     .template-box.selected .media{
         border-color: var(---primary-color);
    }
    .template-box.selected .selected-btn{
        scale: 1;
        opacity: 1;
    }
    .template-box.selected .media,
    .template-box:hover .media{
      box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

</style>
<div class="container-wrapper container-open " ng-app="AppModule" >
    <title><?php echo $this->config->item('productName') ?> | Lets Work</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" >
        <div class="comman-top-bar">
            <div class="edit-box d-flex align-items-center gap-3">
                <div class="back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                        <g clip-path="url(#clip0_105_2116)">
                            <path d="M30 15C30 11.0218 28.4196 7.20644 25.6066 4.3934C22.7936 1.58035 18.9782 0 15 0C11.0218 0 7.20644 1.58035 4.3934 4.3934C1.58035 7.20644 0 11.0218 0 15C0 18.9782 1.58035 22.7936 4.3934 25.6066C7.20644 28.4196 11.0218 30 15 30C18.9782 30 22.7936 28.4196 25.6066 25.6066C28.4196 22.7936 30 18.9782 30 15ZM12.7383 22.084L6.88477 15.8086C6.67969 15.5859 6.5625 15.2988 6.5625 15C6.5625 14.7012 6.67969 14.4082 6.88477 14.1914L12.7383 7.91602C12.9844 7.65234 13.3301 7.5 13.6934 7.5C14.4141 7.5 15 8.08594 15 8.80664V12.1875H20.625C21.6621 12.1875 22.5 13.0254 22.5 14.0625V15.9375C22.5 16.9746 21.6621 17.8125 20.625 17.8125H15V21.1934C15 21.9141 14.4141 22.5 13.6934 22.5C13.3301 22.5 12.9844 22.3477 12.7383 22.084Z" fill="white" fill-opacity="0.6"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_105_2116">
                            <rect width="30" height="30" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="edit">
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img2.png" alt="user">
                        <p class="m-0">YouTube Short Scripts</p>
                    </div>
                    <i class="fa-regular fa-pen-to-square"></i>
                </div>
            </div>
            <div class="btn-boxes">
                <a href="" class="btn btn-blur">Test App</a>
                <a href="" class="btn btn-light text-dark">Publish</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-3 col-12">
                <div class="question-sidebar nav nav-tabs" id="nav-tab" role="tablist">
                    <ul class="questions-list pt-3 px-3 quetion-boxes-tab" id="nav-form-tab" data-bs-toggle="tab" data-bs-target="#nav-form" type="button" role="tab" aria-controls="nav-form" aria-selected="true">
                        <li><a href="javascript:void(0);">Q.1  Topic 1</a></li>
                        <li><a href="javascript:void(0);" class="active">Q.2  Topic 2</a></li>
                        <li><a href="javascript:void(0);">Q.3  Topic 3</a></li>
                        <li><a href="javascript:void(0);" class="add-more-question text-center"><i class="fa-solid me-2 fa-square-plus"></i>Add Question</a></li>
                    </ul>
                    <div class="bottom-nav-tabs">
                        <ul class="d-flex  m-0 flex-column gap-3 px-0 pt-3 px-3 " style="border-top: 1px solid var(--theme-br)">
                            <li><a href="" class="btn btn-light justify-content-start w600 theme-text-color w-100 nav-link quetion-boxes-tab"  id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false"><i class="fa-solid me-2 fa-diamond-turn-right"></i> Ending Action</a></li>
                            <li><a href="" class="btn btn-light justify-content-start w600 theme-text-color w-100 nav-link quetion-boxes-tab" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fa-solid me-2 fa-swatchbook"></i> App Style</a></li>
                        </ul>
                    </div>   
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="tab-content" id="nav-tabContent">
                    <div class="question-box tab-pane fade show active" id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab">
                            <form action="">
                                <div class="row row-gap-2 justify-content-between">
                                    <div class="form-group col-md-5">
                                        <label for="label">Label (Optional)</label>
                                        <input type="text" class="form-control" placeholder="Enter Label" id="label" id="getlabel">
                                    </div>                        
                                    <div class="form-group col-md-5">
                                        <label for="label">Question ID</label>
                                        <div class="d-flex align-items-center pe-3 question-id">
                                            <input type="text" class="border form-control" placeholder="q1topic" id="label" id="getlabel">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </div>    
                                    <div class="form-group col-md-12">
                                        <label for="label">Question  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Your Question Here" id="label" id="getlabel">
                                    </div>                     
                                    <div class="form-group col-md-12">
                                        <label for="label">Button Text  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Button Text Here" id="label" id="getlabel">
                                    </div>       
                                    <div class="col-md-8 justify-content-between row ">
                                        <div class="form-group col-md-5">
                                            <label for="label">Type</label>
                                            <select name="" id="">
                                                <option value="text">Text</option>
                                                <option value="text">Image</option>
                                            </select>
                                        </div>   
                                        <div class="form-group col-md-7">
                                            <label for="label">Required</label>
                                            <div class="d-flex align-items-center gap-3 pt-2">
                                                <div class="radio-wrapper d-flex align-items-center gap-2">
                                                    <input type="radio" name="required" placeholder="Enter Button Text Here" id="yes" id="getlabel">
                                                    <label for="yes" class="w-100 m-0">Yes</label>
                                                </div>
                                                <div class="radio-wrapper d-flex align-items-center gap-2">
                                                    <input type="radio" name="required" placeholder="Enter Button Text Here" id="no" id="getlabel">
                                                    <label for="no" class="w-100 m-0">No</label>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>              
                            </form>   
                    </div>
                    
                    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <h5 class="w700 mb-3">Select Ending Action</h5>
                        <div class="ending-sec-card active">
                            <div class="radio-wrapper">
                                <input type="radio" name="ending-action" id="ending-action" checked>
                                <label for="ending-action">Display AI Response</label>
                            </div>
                            <textarea name="" class="form-control bg-white" > Prompt : Give me a caption for my YouTube shorts video script  below for my post.</textarea>
                        </div>
                        <div class="ending-sec-card ">
                        <div class="radio-wrapper">
                            <input type="radio" name="ending-action" id="ending-action2">
                            <label for="ending-action2">Redirect Link</label> 
                        </div>
                            <input type="text"  class="form-control bg-white" placeholder="https://www.demolink.com/sales-page">
                        </div>
                        <div class="ending-sec-card ">
                            <div class="radio-wrapper">
                                <input type="radio" name="ending-action" id="ending-action3">
                                <label for="ending-action3">Thank You Massage</label>
                            </div>
                            <input type="text"  class="form-control bg-white" placeholder="Form Submit Successfully. Thank You!">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <h5 class="w700">Select Form Style</h5>      
                        <div class="row mt-3 row-gap">
                            <div class="col-lg-4 col-md-6">
                                <div class="template-box selected">
                                    <div class="media">
                                        <img src="<?= $this->config->item('assetsPath')  ?>/images/default-template.png" alt="">
                                    </div>
                                    <div class="content"> <span> Default</span>
                                        <div class="selected-btn"><i class="fa-solid fa-check me-2"></i> Selected </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="template-box">
                                    <div class="media">
                                        <img src="<?= $this->config->item('assetsPath')  ?>/images/default-template.png" alt="">
                                    </div>
                                    <div class="content"> <span> Template 1</span>
                                        <div class="selected-btn"><i class="fa-solid fa-check me-2"></i> Selected </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="template-box">
                                    <div class="media">
                                        <img src="<?= $this->config->item('assetsPath')  ?>/images/default-template.png" alt="">
                                    </div>
                                    <div class="content"> <span> Template 2</span>
                                        <div class="selected-btn"><i class="fa-solid fa-check me-2"></i> Selected </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="template-box">
                                    <div class="media">
                                        <img src="<?= $this->config->item('assetsPath')  ?>/images/default-template.png" alt="">
                                    </div>
                                    <div class="content"> <span> Template 3</span>
                                        <div class="selected-btn"><i class="fa-solid fa-check me-2"></i> Selected </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="template-box">
                                    <div class="media">
                                        <img src="<?= $this->config->item('assetsPath')  ?>/images/default-template.png" alt="">
                                    </div>
                                    <div class="content"> <span> Template 4</span>
                                        <div class="selected-btn"><i class="fa-solid fa-check me-2"></i> Selected </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="template-box">
                                    <div class="media">
                                        <img src="<?= $this->config->item('assetsPath')  ?>/images/default-template.png" alt="">
                                    </div>
                                    <div class="content"> <span> Template 5</span>
                                        <div class="selected-btn"><i class="fa-solid fa-check me-2"></i> Selected </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.quetion-boxes-tab').on('click',function(){
            $('.quetion-boxes-tab').removeClass('active');
            $(this).addClass('active');
        })
        
        $('.ending-sec-card input[name="ending-action"]').on('click',function(){
            $('.ending-sec-card').removeClass('active');
            if ($(this).is(':checked')) {
                $(this).parent().parent().addClass('active');
            }
        })
        $('.template-box').on('click',function(){
            $('.template-box').removeClass('selected');
            $(this).addClass('selected');

        })
    </script>