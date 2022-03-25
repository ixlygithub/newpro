<div class="sidebar" >
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal" style="text-align: center;">{{ __('ADMIN PANEL') }}</a>
        </div>
        <?php $privileges=explode(",",auth()->user()->privileges);?>
       <?php if(auth()->user()->role=="admin") {?>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('User Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>
                         
                        <li @if ($pageSlug == 'userlist') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User List') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- <li <?php  //echo ($pageSlug=="test")?'class="active "':'';?>>
                <a href="{{ route('listtest') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Test') }}</p>
                </a>
            </li> -->
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Test') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'test') class="active " @endif>
                            <a href="{{ route('listtest')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Test') }}</p>
                            </a>
                        </li>
                         
                        <li>
                            <a href="{{ route('listaudio')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Audio Setings') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li <?php  echo ($pageSlug=="tags")?'class="active "':'';?>>
                <a href="{{ route('listtag') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Tag') }}</p>
                </a>
            </li>
              <li <?php  echo ($pageSlug=="questions")?'class="active "':'';?>>
                <a href="{{ route('questions') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Questions') }}</p>
                </a>
            </li>
            <li <?php  echo ($pageSlug=="questionscategory")?'class="active "':'';?>>
                <a href="{{ route('listquestioncategory') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Question Category') }}</p>
                </a>
            </li>
            <li <?php   echo ($pageSlug=="category")?'class="active "':'';?>>
                <a href="{{ route('category') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Category') }}</p>
                </a>
            </li>
            <li <?php  echo ($pageSlug=="weightage")?'class="active "':'';?>>
                <a href="{{ route('weightage') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Weightage') }}</p>
                </a>
            </li>
            <li <?php  echo ($pageSlug=="feedback")?'class="active "':'';?>>
                <a href="{{ route('feedback') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('User Feedback') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#reports" aria-expanded="true">
                    <i class="fas fa-chart-bar" ></i>
                    <span class="nav-link-text" >{{ __('Reports') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="reports">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'reports') class="active " @endif>
                            <a href="{{ route('reports')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Report') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'questionreports') class="active " @endif>
                            <a href="{{ route('questionreports')  }}">
                                <i class="tim-icons icon-chart-bar-32"></i>
                                <p>{{ __(' Category Report') }}</p>
                            </a>
                        </li>
                         <li @if ($pageSlug == 'tagreport') class="active " @endif>
                            <a href="{{ route('tagreport')  }}">
                                <i class="tim-icons icon-chart-bar-32"></i>
                                <p>{{ __('Tag Report') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'weightagereports') class="active " @endif>
                            <a href="{{ route('weightagereports')  }}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <p>{{ __('Weightage Reports') }}</p>
                            </a>
                        </li>
                        <li <?php  echo ($pageSlug=="websitereport")?'class="active "':'';?>>
                            <a href="{{ route('websitereport') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Website Performance') }}</p>
                            </a>
                        </li>
                        <li <?php  echo ($pageSlug=="audioreport")?'class="active "':'';?>>
                            <a href="{{ route('audioreport') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Audio Questions') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <?php } else{?>
           <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('User Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>
                         
                         <?php 
                        if(in_array("user",$privileges)) {?>
                        <li @if ($pageSlug == 'userlist') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User List') }}</p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <?php if(in_array("listtest",$privileges)) {?>
            <li <?php  echo ($pageSlug=="test")?'class="active "':'';?>>
                <a href="{{ route('listtest') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Test') }}</p>
                </a>
            </li>
            <?php } ?>
            <?php if(in_array("listtag",$privileges)) {?>
            <li <?php  echo ($pageSlug=="tags")?'class="active "':'';?>>
                <a href="{{ route('listtag') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Tag') }}</p>
                </a>
            </li>
            <?php } ?>
            <?php if(in_array("questions",$privileges)) {?>
              <li <?php  echo ($pageSlug=="questions")?'class="active "':'';?>>
                <a href="{{ route('questions') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Questions') }}</p>
                </a>
            </li>
            <?php } ?>
            <?php if(in_array("listquestioncategory",$privileges)) {?>
            <li <?php  echo ($pageSlug=="questionscategory")?'class="active "':'';?>>
                <a href="{{ route('listquestioncategory') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Question Category') }}</p>
                </a>
            </li>
            <?php } ?>
             <?php if(in_array("category",$privileges)) {?>
            <li <?php   echo ($pageSlug=="category")?'class="active "':'';?>>
                <a href="{{ route('category') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Category') }}</p>
                </a>
            </li>
            <?php } ?>
             <?php if(in_array("weightage",$privileges)) {?>
            <li <?php  echo ($pageSlug=="weightage")?'class="active "':'';?>>
                <a href="{{ route('weightage') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Weightage') }}</p>
                </a>
            </li>
            <?php } ?>
            <li <?php  echo ($pageSlug=="feedback")?'class="active "':'';?>>
                <a href="{{ route('feedback') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('User Feedback') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#reports" aria-expanded="true">
                    <i class="fas fa-chart-bar" ></i>
                    <span class="nav-link-text" >{{ __('Reports') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="reports">
                    <ul class="nav pl-4">
                        <?php if(in_array("reports",$privileges)) {?>
                        <li @if ($pageSlug == 'reports') class="active " @endif>
                            <a href="{{ route('reports')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Report') }}</p>
                            </a>
                        </li>
                        <?php } if(in_array("questionreports",$privileges)) { ?>
                        <li @if ($pageSlug == 'questionreports') class="active " @endif>
                            <a href="{{ route('questionreports')  }}">
                                <i class="tim-icons icon-chart-bar-32"></i>
                                <p>{{ __('Category Report') }}</p>
                            </a>
                        </li>
                        <?php }  if(in_array("tagreports",$privileges)) { ?>
                        <li @if ($pageSlug == 'tagreports') class="active " @endif>
                            <a href="{{ route('tagreports')  }}">
                                <i class="tim-icons icon-chart-bar-32"></i>
                                <p>{{ __('Tag Report') }}</p>
                            </a>
                        </li>
                        <?php }if(in_array("weightagereports",$privileges)) { ?>
                        <li @if ($pageSlug == 'weightagereports') class="active " @endif>
                            <a href="{{ route('weightagereports')  }}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <p>{{ __('Weightage Reports') }}</p>
                            </a>
                        </li>
                        <?php } if(in_array("websitereport",$privileges)) { ?>
                        <li <?php  echo ($pageSlug=="websitereport")?'class="active "':'';?>>
                            <a href="{{ route('websitereport') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Website Performance') }}</p>
                            </a>
                        </li>
                        <?php } if(in_array("audioreport",$privileges)) { ?>
                        <li <?php  echo ($pageSlug=="audioreport")?'class="active "':'';?>>
                            <a href="{{ route('audioreport') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Audio Questions') }}</p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
        </ul>
            <?php } ?>
    </div>
</div>
