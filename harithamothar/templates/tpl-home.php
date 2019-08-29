<?php /* Template Name: Home */
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage PixelsDen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<nav>
      <ul>
        <li class="landing" data-url="">Home</li>
        <li class="projects" data-url="projects">Projects</li>
        <li class="apoorva-gallery" data-url="apoorva-gallery">Apoorva Gallery</li>
        <li class="team" data-url="team">Team</li>
        <li class="contact" data-url="contact">Contact</li>
        <li class="shrihari" data-url="shrihari"><a href="/shrihari"><img src="<?php bloginfo( 'template_directory' ); ?>/images/shrihari.svg" />Shrihari</a></li>
      </ul>
    </nav>
    <div class="logowrapper">
      <div class="container">
        <a href="/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/logo.svg" alt="logo" class="desktop" /></a>
        <a href="/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/logo-mobile.svg" alt="logo" class="mobile" /></a>
        <div class="hamburger">
          <div class="hamb-wrap">
            <div class="stick stick-1"></div>
            <div class="stick stick-2"></div>
            <div class="stick stick-3"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <div class="inner-wrapper">
        <!-- Landing page -->
        <div id="landing" class="pages active">
          <?php
          $home_id = get_option( 'page_on_front' );
          $rows = get_field('home_anim_text',$home_id);
          if($rows)
          { ?>
            <div class="owl-carousel" id="text-slider">
            <?php
            foreach($rows as $row)
            { ?>
              <div class="item"><?php echo $row['text']; ?></div>
            <?php }  ?>
            </div>
          <?php } ?>
          
          <?php
          $imgrows = get_field('home_slider_image',$home_id);
          if($imgrows)
          { ?>
            <div id="homeslider" class="owl-carousel">
            <?php
            foreach($imgrows as $row)
            { ?>
              <img class="owl-lazy" data-src="<?php echo $row['image']; ?>" alt="" />
            <?php }  ?>
            </div>
          <?php } ?>
          <div class="fixedtext">
            <?php echo get_field('home_page_text',$home_id); ?>
          </div>
        </div>
        <!-- Landing page -->

        <!-- Project page -->
        <?php
          $proj_id = get_id_by_slug("projects");
          $projects = get_field('project',$proj_id);
        ?>
        <div id="projects" class="pages">
          <div class="project-inner">
            <div class="container">
              <div class="fixedleft">
                <h2><?php echo get_the_title( $proj_id ); ?></h2>
                <p>
                  <?php echo get_field("main_text",$proj_id) ?>
                </p>
              </div>
              <div class="projectblock">
                <div class="filtering">
                  <div class="numberofprojects">
                    Showing <span class="count"></span> Projects
                  </div>
                  <div class="showing"><span class="from">1</span> to <span class="to">8</span></div>
                  <div class="navigation">
                    <div class="prevset"><span></span></div>
                    <div class="nextset"><span></span></div>
                  </div>
                </div>
                <div class="projectlist">
                </div>
                <div class="loadmore">LOAD MORE</div>
              </div>
            </div>
          </div>
        </div>
        <!-- Project page -->
        <!-- Apoorva page -->
        <?php
          $apoorva_id = get_id_by_slug("apoorva-gallery");
          $apoorva = get_field('apoorva',$apoorva_id);
        ?>
        <div id="apoorva-gallery" class="pages">
          <div class="apoorva-inner">
            <div class="container">
              <div class="fixedleft">
                <h2><?php echo get_the_title( $apoorva_id ); ?></h2>
                <p>
                  <?php echo get_field("main_text",$apoorva_id) ?>
                </p>
              </div>
              <div class="apoorvablock">
                <div id="apoorvalist">
                  <div class="horVerSlider desktop">
                    <div class="close"></div>
                    <div class="vertical-wrapper">
                      <div class="vertical-nav">
                        <div class="top"><i class="arrow up"></i></div>
                        <div class="bottom"><i class="arrow down"></i></div>
                      </div>

                      <?php
                      if($apoorva)
                      { ?>
                        <div id="vertical-slider">
                          <ul>
                          <?php
                          foreach($apoorva as $row)
                          { ?>
                            <li data-image="<?php echo $row["gallery_image"]; ?>">
                              <img src="<?php bloginfo( 'template_directory' ); ?>/images/loader.gif" />
                            </li>
                          <?php }  ?>
                          </ul>
                        </div>
                      <?php } ?>
                    </div>
                    <?php if($apoorva) { ?>
                    <div class="horizon-wrapper ">
                      <div class="horizone-nav">
                        <div class="prev"><i class="arrow left"></i></div>
                        <div class="next"><i class="arrow right"></i></div>
                      </div>
                      <div id="horizon-slider" class="zoomin">
                        <ul>
                          <?php
                          foreach($apoorva as $row)
                          { ?>
                            <li data-image="<?php echo $row["gallery_image"]; ?>">
                              <img src="<?php bloginfo( 'template_directory' ); ?>/images/loader.gif" />
                            </li>
                          <?php }  ?>
                        </ul>
                        <div class="dots"><div class="dotwrap"></div></div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="owl-carousel mobile" id="apoorva-slider">
                    <?php
                      foreach($apoorva as $row)
                      { ?>
                      <img class="owl-lazy" data-src="<?php echo $row["gallery_image"]; ?>" alt="" />
                    <?php }  ?>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <!-- Apoorva page -->
        <!-- Team page -->
        <?php
          $team_id = get_id_by_slug("team");
          $team = get_field('team',$team_id);
        ?>
        <div id="team" class="pages">
          <div class="team-inner">
            <div class="container">
              <?php if($team) { ?>
              <div class="teamblock">
                <div class="teamlist">  
                  <?php
                  $i = 1;
                  foreach($team as $row)
                  { 
                    if($i<4) {
                      $class ="rowtwo";
                      $arrowclass ="right-arrow";
                    } else {
                      $class ="";
                      $arrowclass ="left-arrow";
                    }?>
                    <div class="item item-<?php echo $i." ".$class; ?>">
                      <div class="image-block" style="background-image: url('<?php  echo $row["image"]; ?>')"></div>
                      <div class="content <?php echo $arrowclass; ?>">
                        <div class="inner">
                          <h2><?php echo $row["name"]; ?></h2>
                          <p><?php echo $row["qual_desig"]; ?></p>
                        </div>
                      </div>
                    </div>
                  <?php $i++; }  ?>                
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- Team page -->
        <!-- Contact page -->
        <?php
          $contact_id = get_id_by_slug("contact");
        ?>
        <div id="contact" class="pages">
          <div class="contact-inner">
            <div class="container">
              <div class="contact-content">
                <div id="map" style="background-image: url('<?php bloginfo( 'template_directory' ); ?>/images/map.jpg')"></div>
                <div class="details">
                  <div id="address">
                    <h2>Contact Us</h2>
                    <address>
                      <div>
                        <?php
                          if(get_field("address",$contact_id)) {
                            echo get_field("address",$contact_id);
                          }
                        ?>
                      </div>
                      
                      <?php if(get_field("telephone",$contact_id)) { ?>
                        <div class="telephone">
                        <label for="telephone">Telephone</label
                        ><span>: <?php echo get_field("telephone",$contact_id); ?></span>
                        </div>
                      <?php } ?>  
                      <?php if(get_field("fax",$contact_id)) { ?>                    
                      <div>
                        <label for="fax">Fax</label
                        ><span>: <?php echo get_field("fax",$contact_id); ?></span>
                      </div>
                      <?php } ?>  
                      <?php if(get_field("hot_line",$contact_id)) { ?>           
                      <div>
                        <label for="hot1">Hotline</label
                        ><span>: <?php echo get_field("hot_line",$contact_id); ?></span>
                      </div>
                      <?php } ?> 
                      <?php if(get_field("e_mail",$contact_id)) { ?> 
                      <div class="email">
                        <label for="email">E-mail</label>
                        <span
                          >:
                          <a href="mailto:<?php echo get_field("e_mail",$contact_id); ?>"
                            ><?php echo get_field("e_mail",$contact_id); ?></a
                          >
                        </span>
                      </div>
                      <?php } ?> 
                    </address>
                    <?php if(get_field("facebook",$contact_id) || get_field("twitter",$contact_id) || get_field("instagram",$contact_id)|| get_field("youtube",$contact_id)) { ?>
                    <div id="socialmedia">
                      <h2>Find us on Social Media</h2>
                      <ul>
                        <?php if(get_field("facebook",$contact_id)) { ?>
                        <li>
                          <a href="<?php echo get_field("facebook",$contact_id); ?>" target="_blank"
                            ><img
                              src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQzMC4xMTMgNDMwLjExNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDMwLjExMyA0MzAuMTE0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IkZhY2Vib29rIiBkPSJNMTU4LjA4MSw4My4zYzAsMTAuODM5LDAsNTkuMjE4LDAsNTkuMjE4aC00My4zODV2NzIuNDEyaDQzLjM4NXYyMTUuMTgzaDg5LjEyMlYyMTQuOTM2aDU5LjgwNSAgIGMwLDAsNS42MDEtMzQuNzIxLDguMzE2LTcyLjY4NWMtNy43ODQsMC02Ny43ODQsMC02Ny43ODQsMHMwLTQyLjEyNywwLTQ5LjUxMWMwLTcuNCw5LjcxNy0xNy4zNTQsMTkuMzIxLTE3LjM1NCAgIGM5LjU4NiwwLDI5LjgxOCwwLDQ4LjU1NywwYzAtOS44NTksMC00My45MjQsMC03NS4zODVjLTI1LjAxNiwwLTUzLjQ3NiwwLTY2LjAyMSwwQzE1NS44NzgtMC4wMDQsMTU4LjA4MSw3Mi40OCwxNTguMDgxLDgzLjN6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="
                          /></a>
                        </li>
                        <?php } ?>
                        <?php if(get_field("twitter",$contact_id)) { ?>
                        <li>
                          <a href="<?php echo get_field("twitter",$contact_id); ?>" target="_blank">
                            <img
                              src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYxMiA2MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYxMiA2MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNjEyLDExNi4yNThjLTIyLjUyNSw5Ljk4MS00Ni42OTQsMTYuNzUtNzIuMDg4LDE5Ljc3MmMyNS45MjktMTUuNTI3LDQ1Ljc3Ny00MC4xNTUsNTUuMTg0LTY5LjQxMSAgICBjLTI0LjMyMiwxNC4zNzktNTEuMTY5LDI0LjgyLTc5Ljc3NSwzMC40OGMtMjIuOTA3LTI0LjQzNy01NS40OS0zOS42NTgtOTEuNjMtMzkuNjU4Yy02OS4zMzQsMC0xMjUuNTUxLDU2LjIxNy0xMjUuNTUxLDEyNS41MTMgICAgYzAsOS44MjgsMS4xMDksMTkuNDI3LDMuMjUxLDI4LjYwNkMxOTcuMDY1LDIwNi4zMiwxMDQuNTU2LDE1Ni4zMzcsNDIuNjQxLDgwLjM4NmMtMTAuODIzLDE4LjUxLTE2Ljk4LDQwLjA3OC0xNi45OCw2My4xMDEgICAgYzAsNDMuNTU5LDIyLjE4MSw4MS45OTMsNTUuODM1LDEwNC40NzljLTIwLjU3NS0wLjY4OC0zOS45MjYtNi4zNDgtNTYuODY3LTE1Ljc1NnYxLjU2OGMwLDYwLjgwNiw0My4yOTEsMTExLjU1NCwxMDAuNjkzLDEyMy4xMDQgICAgYy0xMC41MTcsMi44My0yMS42MDcsNC4zOTgtMzMuMDgsNC4zOThjLTguMTA3LDAtMTUuOTQ3LTAuODAzLTIzLjYzNC0yLjMzM2MxNS45ODUsNDkuOTA3LDYyLjMzNiw4Ni4xOTksMTE3LjI1Myw4Ny4xOTQgICAgYy00Mi45NDcsMzMuNjU0LTk3LjA5OSw1My42NTUtMTU1LjkxNiw1My42NTVjLTEwLjEzNCwwLTIwLjExNi0wLjYxMi0yOS45NDQtMS43MjFjNTUuNTY3LDM1LjY4MSwxMjEuNTM2LDU2LjQ4NSwxOTIuNDM4LDU2LjQ4NSAgICBjMjMwLjk0OCwwLDM1Ny4xODgtMTkxLjI5MSwzNTcuMTg4LTM1Ny4xODhsLTAuNDIxLTE2LjI1M0M1NzMuODcyLDE2My41MjYsNTk1LjIxMSwxNDEuNDIyLDYxMiwxMTYuMjU4eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo="
                            />
                          </a>
                        </li>
                        <?php } ?>
                        <?php if(get_field("instagram",$contact_id)) { ?>
                        <li>
                          <a href="<?php echo get_field("instagram",$contact_id); ?>" 
                          target="_blank"><img
                              src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTM3My42NTksMEgxMzguMzQxQzYyLjA2LDAsMCw2Mi4wNiwwLDEzOC4zNDF2MjM1LjMxOEMwLDQ0OS45NCw2Mi4wNiw1MTIsMTM4LjM0MSw1MTJoMjM1LjMxOCAgICBDNDQ5Ljk0LDUxMiw1MTIsNDQ5Ljk0LDUxMiwzNzMuNjU5VjEzOC4zNDFDNTEyLDYyLjA2LDQ0OS45NCwwLDM3My42NTksMHogTTQ3MC42MzYsMzczLjY1OSAgICBjMCw1My40NzMtNDMuNTAzLDk2Ljk3Ny05Ni45NzcsOTYuOTc3SDEzOC4zNDFjLTUzLjQ3MywwLTk2Ljk3Ny00My41MDMtOTYuOTc3LTk2Ljk3N1YxMzguMzQxICAgIGMwLTUzLjQ3Myw0My41MDMtOTYuOTc3LDk2Ljk3Ny05Ni45NzdoMjM1LjMxOGM1My40NzMsMCw5Ni45NzcsNDMuNTAzLDk2Ljk3Nyw5Ni45NzdWMzczLjY1OXoiIGZpbGw9IiNGRkZGRkYiLz4KCTwvZz4KPC9nPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zNzAuNTg2LDIzOC4xNDFjLTMuNjQtMjQuNTQ3LTE0LjgzOS00Ni43OTUtMzIuMzg2LTY0LjM0MmMtMTcuNTQ3LTE3LjU0Ni0zOS43OTUtMjguNzQ2LTY0LjM0MS0zMi4zODUgICAgYy0xMS4xNzYtMS42NTctMjIuNTA3LTEuNjU3LTMzLjY4MiwwYy0zMC4zMzYsNC40OTktNTcuMTAzLDIwLjU0MS03NS4zNzIsNDUuMTcyYy0xOC4yNjksMjQuNjMxLTI1Ljg1NCw1NC45MDMtMjEuMzU1LDg1LjIzNyAgICBjNC40OTksMzAuMzM1LDIwLjU0MSw1Ny4xMDIsNDUuMTcyLDc1LjM3MmMxOS45OTYsMTQuODMxLDQzLjcwNiwyMi42MTksNjguMTUzLDIyLjYxOWM1LjY2NywwLDExLjM3NS0wLjQxOCwxNy4wODMtMS4yNjUgICAgYzMwLjMzNi00LjQ5OSw1Ny4xMDMtMjAuNTQxLDc1LjM3Mi00NS4xNzJDMzY3LjUsMjk4Ljc0NywzNzUuMDg1LDI2OC40NzYsMzcwLjU4NiwyMzguMTQxeiBNMjY3Ljc5MSwzMjcuNjMyICAgIGMtMTkuNDA1LDIuODgyLTM4Ljc3LTEuOTczLTU0LjUyNy0xMy42NmMtMTUuNzU3LTExLjY4Ny0yNi4wMTktMjguODExLTI4Ljg5Ni00OC4yMTZjLTIuODc4LTE5LjQwNSwxLjk3My0zOC43NywxMy42Ni01NC41MjcgICAgYzExLjY4OC0xNS43NTcsMjguODExLTI2LjAxOSw0OC4yMTctMjguODk3YzMuNTc0LTAuNTMsNy4xNzMtMC43OTUsMTAuNzcyLTAuNzk1czcuMTk5LDAuMjY1LDEwLjc3MywwLjc5NiAgICBjMzIuMjMxLDQuNzc5LDU3LjA5OCwyOS42NDUsNjEuODc4LDYxLjg3N0MzMzUuNjA4LDI4NC4yNjgsMzA3Ljg1MSwzMjEuNjkyLDI2Ny43OTEsMzI3LjYzMnoiIGZpbGw9IiNGRkZGRkYiLz4KCTwvZz4KPC9nPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00MDAuMDQ5LDExMS45NTFjLTMuODUyLTMuODUxLTkuMTgzLTYuMDU4LTE0LjYyNS02LjA1OGMtNS40NDIsMC0xMC43NzMsMi4yMDYtMTQuNjI1LDYuMDU4ICAgIGMtMy44NTEsMy44NTItNi4wNTgsOS4xNzQtNi4wNTgsMTQuNjI1YzAsNS40NTEsMi4yMDcsMTAuNzczLDYuMDU4LDE0LjYyNWMzLjg1MiwzLjg1MSw5LjE4Myw2LjA1OCwxNC42MjUsNi4wNTggICAgYzUuNDQyLDAsMTAuNzczLTIuMjA2LDE0LjYyNS02LjA1OGMzLjg1MS0zLjg1Miw2LjA1OC05LjE4Myw2LjA1OC0xNC42MjVDNDA2LjEwNywxMjEuMTMzLDQwMy45LDExNS44MDIsNDAwLjA0OSwxMTEuOTUxeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo="
                          /></a>
                        </li>
                        <?php } ?>
                        <?php if(get_field("youtube",$contact_id)) { ?>
                        <li>
                          <a href="<?php echo get_field("youtube",$contact_id); ?>"
                          target="_blank"><img
                              src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDkwIDkwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA5MCA5MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8Zz4KCTxwYXRoIGlkPSJZb3VUdWJlIiBkPSJNNzAuOTM5LDY1LjgzMkg2NmwwLjAyMy0yLjg2OWMwLTEuMjc1LDEuMDQ3LTIuMzE4LDIuMzI2LTIuMzE4aDAuMzE1YzEuMjgyLDAsMi4zMzIsMS4wNDMsMi4zMzIsMi4zMTggICBMNzAuOTM5LDY1LjgzMnogTTUyLjQxMyw1OS42ODRjLTEuMjUzLDAtMi4yNzgsMC44NDItMi4yNzgsMS44NzNWNzUuNTFjMCwxLjAyOSwxLjAyNSwxLjg2OSwyLjI3OCwxLjg2OSAgIGMxLjI1OCwwLDIuMjg0LTAuODQsMi4yODQtMS44NjlWNjEuNTU3QzU0LjY5Nyw2MC41MjUsNTMuNjcxLDU5LjY4NCw1Mi40MTMsNTkuNjg0eiBNODIuNSw1MS44Nzl2MjYuNTQ0ICAgQzgyLjUsODQuNzksNzYuOTc5LDkwLDcwLjIzLDkwSDE5Ljc3MUMxMy4wMiw5MCw3LjUsODQuNzksNy41LDc4LjQyM1Y1MS44NzljMC02LjM2Nyw1LjUyLTExLjU3OCwxMi4yNzEtMTEuNTc4SDcwLjIzICAgQzc2Ljk3OSw0MC4zMDEsODIuNSw0NS41MTIsODIuNSw1MS44Nzl6IE0yMy4xMzcsODEuMzA1bC0wLjAwNC0yNy45NjFsNi4yNTUsMC4wMDJ2LTQuMTQzbC0xNi42NzQtMC4wMjV2NC4wNzNsNS4yMDUsMC4wMTV2MjguMDM5ICAgSDIzLjEzN3ogTTQxLjg4Nyw1Ny41MDloLTUuMjE1djE0LjkzMWMwLDIuMTYsMC4xMzEsMy4yNC0wLjAwOCwzLjYyMWMtMC40MjQsMS4xNTgtMi4zMywyLjM4OC0zLjA3MywwLjEyNSAgIGMtMC4xMjYtMC4zOTYtMC4wMTUtMS41OTEtMC4wMTctMy42NDNsLTAuMDIxLTE1LjAzNGgtNS4xODZsMC4wMTYsMTQuNzk4YzAuMDA0LDIuMjY4LTAuMDUxLDMuOTU5LDAuMDE4LDQuNzI5ICAgYzAuMTI3LDEuMzU3LDAuMDgyLDIuOTM5LDEuMzQxLDMuODQzYzIuMzQ2LDEuNjksNi44NDMtMC4yNTIsNy45NjgtMi42NjhsLTAuMDEsMy4wODNsNC4xODgsMC4wMDVMNDEuODg3LDU3LjUwOUw0MS44ODcsNTcuNTA5eiAgICBNNTguNTcsNzQuNjA3TDU4LjU1OSw2Mi4xOGMtMC4wMDQtNC43MzYtMy41NDctNy41NzItOC4zNTYtMy43NGwwLjAyMS05LjIzOWwtNS4yMDksMC4wMDhsLTAuMDI1LDMxLjg5bDQuMjg0LTAuMDYybDAuMzktMS45ODYgICBDNTUuMTM3LDg0LjA3Miw1OC41NzgsODAuNjMxLDU4LjU3LDc0LjYwN3ogTTc0Ljg5MSw3Mi45NmwtMy45MSwwLjAyMWMtMC4wMDIsMC4xNTUtMC4wMDgsMC4zMzQtMC4wMSwwLjUyOXYyLjE4MiAgIGMwLDEuMTY4LTAuOTY1LDIuMTE5LTIuMTM3LDIuMTE5aC0wLjc2NmMtMS4xNzQsMC0yLjEzOS0wLjk1MS0yLjEzOS0yLjExOVY3NS40NXYtMi40di0zLjA5N2g4Ljk1NHYtMy4zNyAgIGMwLTIuNDYzLTAuMDYzLTQuOTI1LTAuMjY3LTYuMzMzYy0wLjY0MS00LjQ1NC02Ljg5My01LjE2MS0xMC4wNTEtMi44ODFjLTAuOTkxLDAuNzEyLTEuNzQ4LDEuNjY1LTIuMTg4LDIuOTQ1ICAgYy0wLjQ0NCwxLjI4MS0wLjY2NSwzLjAzMS0wLjY2NSw1LjI1NHY3LjQxQzYxLjcxNCw4NS4yOTYsNzYuNjc2LDgzLjU1NSw3NC44OTEsNzIuOTZ6IE01NC44MzMsMzIuNzMyICAgYzAuMjY5LDAuNjU0LDAuNjg3LDEuMTg0LDEuMjU0LDEuNTg0YzAuNTYsMC4zOTQsMS4yNzYsMC41OTIsMi4xMzQsMC41OTJjMC43NTIsMCwxLjQxOC0wLjIwMywxLjk5OC0wLjYyMiAgIGMwLjU3OC0wLjQxNywxLjA2NS0xLjA0LDEuNDYzLTEuODcxbC0wLjA5OSwyLjA0Nmg1LjgxM1Y5Ljc0SDYyLjgydjE5LjI0YzAsMS4wNDItMC44NTgsMS44OTUtMS45MDcsMS44OTUgICBjLTEuMDQzLDAtMS45MDQtMC44NTMtMS45MDQtMS44OTVWOS43NGgtNC43NzZ2MTYuNjc0YzAsMi4xMjQsMC4wMzksMy41NCwwLjEwMiw0LjI1OEM1NC40LDMxLjM4NSw1NC41NjQsMzIuMDY5LDU0LjgzMywzMi43MzJ6ICAgIE0zNy4yMTcsMTguNzdjMC0yLjM3MywwLjE5OC00LjIyNiwwLjU5MS01LjU2MmMwLjM5Ni0xLjMzMSwxLjEwNy0yLjQwMSwyLjEzNy0zLjIwOGMxLjAyNy0wLjgxMSwyLjM0Mi0xLjIxNywzLjk0MS0xLjIxNyAgIGMxLjM0NSwwLDIuNDk3LDAuMjY0LDMuNDU5LDAuNzgxYzAuOTY3LDAuNTIsMS43MTMsMS4xOTUsMi4yMywyLjAyOGMwLjUyNywwLjgzNiwwLjg4NSwxLjY5NSwxLjA3NiwyLjU3NCAgIGMwLjE5NSwwLjg5MSwwLjI5MSwyLjIzNSwwLjI5MSw0LjA0OHY2LjI1MmMwLDIuMjkzLTAuMDkyLDMuOTgtMC4yNzEsNS4wNTFjLTAuMTc3LDEuMDc0LTAuNTU3LDIuMDctMS4xNDYsMy4wMDQgICBjLTAuNTgsMC45MjQtMS4zMjksMS42MTUtMi4yMzcsMi4wNTZjLTAuOTE4LDAuNDQ1LTEuOTY4LDAuNjYzLTMuMTU0LDAuNjYzYy0xLjMyNSwwLTIuNDQxLTAuMTgzLTMuMzYxLTAuNTY1ICAgYy0wLjkyMy0wLjM4LTEuNjM2LTAuOTUzLTIuMTQ0LTEuNzE0Yy0wLjUxMy0wLjc2Mi0wLjg3NC0xLjY5LTEuMDkyLTIuNzcyYy0wLjIxOS0xLjA4MS0wLjMyMy0yLjcwNy0wLjMyMy00Ljg3NEwzNy4yMTcsMTguNzcgICBMMzcuMjE3LDE4Ljc3eiBNNDEuNzcsMjguNTljMCwxLjQsMS4wNDIsMi41NDMsMi4zMTEsMi41NDNjMS4yNywwLDIuMzA4LTEuMTQzLDIuMzA4LTIuNTQzVjE1LjQzYzAtMS4zOTgtMS4wMzgtMi41NDEtMi4zMDgtMi41NDEgICBjLTEuMjY5LDAtMi4zMTEsMS4xNDMtMi4zMTEsMi41NDFWMjguNTl6IE0yNS42ODIsMzUuMjM1aDUuNDg0bDAuMDA2LTE4Ljk2bDYuNDgtMTYuMjQyaC01Ljk5OGwtMy40NDUsMTIuMDY0TDI0LjcxNSwwaC01LjkzNiAgIGw2Ljg5NCwxNi4yODRMMjUuNjgyLDM1LjIzNXoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K"
                          /></a>
                        </li>
                        <?php } ?>
                      </ul>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Contact page -->
      </div>
      <div class="popup-wrapper">
        <div class="popup-inner">
            <div class="close">
            <img src="<?php bloginfo( 'template_directory' ); ?>/images/close.svg" />
            </div>
            
            <div class="content-block">
              <div class="image">
                <img src=""/>                
              </div>              
              
              <div class="content">
                <h2></h2>
                <div class="text-content"></div>
                <div class="tags">
                </div>
              </div>
            </div>            
        </div>
      </div>
      <div class="youtube-popup">        
        <div class="popup-inner">
          <div class="close">
              <img src="<?php bloginfo( 'template_directory' ); ?>/images/close.svg" />
          </div>
          <div class="youtube-holder"></div>
        </div>
      </div>
    </div>    
<?php get_footer();?>
<script type="text/template" id="project">
<div class="item">
  <div class="item-inner" style=""></div>
  <div class="content">
    <h2></h2>
    <p></p>
    <div class="tags">
      
    </div>                       
  </div>
  <span class="video"><img src="<?php bloginfo( 'template_directory' ); ?>/images/play-button.svg"/></span> 
  <span class="expand"><img src="<?php bloginfo( 'template_directory' ); ?>/images/expand.svg"/></span>
</div>
</script>


