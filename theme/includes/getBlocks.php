<?php
  function get_blocks() {
    global $post;

    $fields = get_fields($post->ID);
    loop_blocks($fields);
  }

  function loop_blocks($blocks) {
    if (isset($blocks['blocks'])){
      if ($blocks['blocks']){
        foreach ($blocks['blocks'] as $key => $block) {
          switch ($block['acf_fc_layout']) {
            case 'global_block':
              if ($block['global_block']){
                $blocks = get_fields($block['global_block'][0]);
                loop_blocks($blocks);
              }
              break;
            case 'fullwidth_text':
              include 'blocks/fullwidth_text.php';
              break;
              case 'banner':
                include 'blocks/banner.php';
                break;
                case 'about':
                  include 'blocks/about.php';
                  break;
                  case 'newsletter':
                    include 'blocks/newsletter.php';
                    break;
                    case 'music':
                      include 'blocks/music.php';
                      break;
                      case 'slides':
                        include 'blocks/Slides.php';
                        break;
                        case 'overlap':
                          include 'blocks/overlap.php';
                          break;
                          case 'main_banner':
                            include 'blocks/main-banner.php';
                            break;
                            case 'dual_image':
                              include 'blocks/dual-image.php';
                              break;
                              case 'heading':
                                include 'blocks/heading.php';
                                break;
                                case 'author_card':
                                  include 'blocks/author-card.php';
                                  break;
                                  case 'text_image':
                                    include 'blocks/text-image.php';
                                    break;
                                    case 'tabs':
                                      include 'blocks/tabs.php';
                                      break;
                                      case 'music_field':
                                        include 'blocks/soical-icons.php';
                                        break;
                                        case 'video_section':
                                          include 'blocks/video-section.php';
                                          break;
                                          case 'music_banner':
                                            include 'blocks/music_banner.php';
                                            break;
                                            case 'video_banner':
                                              include 'blocks/video_banner.php';
                                              break;
                                              case 'music_links':
                                                include 'blocks/music_links.php';
                                                break;
            
          }
        }
      }
    }
  }

?>