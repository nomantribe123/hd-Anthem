<?php

class Blog_Header {
    public static function render() {

        // Skip rendering if we're in Elementor editor
        if (isset($_GET['elementor-preview'])) {
            return;
        }
        
        // Skip if we're in any kind of Elementor editor mode
        if (\Elementor\Plugin::$instance->editor->is_edit_mode() || 
            \Elementor\Plugin::$instance->preview->is_preview_mode()) {
            return;
        }
        
        $categories = get_the_category();
        $category_name = !empty($categories) ? $categories[0]->name : 'CATEGORY';
        $reading_time = get_field('reading_time') ? get_field('reading_time') . ' min read' : '5 min read';
        ?>
        <header class="py-6 lg:py-8">
            <div class="container">
                <!--  -->
                
                <div class="flex flex-container blog-header">
                    <div style="flex-grow: 5;">
                        <div class="mb-20 lg:mb-25">
                            <p class="text-l font-medium mt-4" style="margin: 50px 0px; width: 80%; ">
                                <span><a href="<?php echo home_url(); ?>">Homepage</a></span> - 
                                <a href="<?php echo get_permalink(); ?>" class="hover:brightness-80"
                                    style="background-color: #d3d3d36b;border-radius: 30px;padding: 12px;">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </p>
                            <h1 style ="max-width: 420px;" class="text-6xl font-black mb-13 site-post-title"><?php echo get_the_title(); ?></h1>
                            <div class="text-l mb-4">
                                <p class="font-medium">By <?php echo get_the_author(); ?></p>
                            </div>
                            <div class=" flex flex-wrap text-l mb-8">
                                <p class="font-medium">
                                    <?php echo get_the_date('d F Y'); ?> 
                                    <svg class="ml-2 inline" 
                                        width="10" height="10" xmlns="http://www.w3.org/2000/svg" >
                                        <circle cx="5" cy="5" r="4" fill="black" />
                                    </svg>
                                    <span class="ml-2"><?php echo esc_html($reading_time); ?></span>
                                </p>
                            </div>
                            
                            <div class="text-xl">
                                <div class="mb-4 text-xl">Share this post</div>
                                <div class="flex flex-wrap gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="hover:brightness-80"
                                    style="background-color: #d3d3d36b;border-radius: 30px;padding: 12px;">
                                    <svg class="w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12.3038C22 6.74719 17.5229 2.24268 12 2.24268C6.47715 2.24268 2 6.74719 2 12.3038C2 17.3255 5.65684 21.4879 10.4375 22.2427V15.2121H7.89844V12.3038H10.4375V10.0872C10.4375 7.56564 11.9305 6.1728 14.2146 6.1728C15.3088 6.1728 16.4531 6.36931 16.4531 6.36931V8.84529H15.1922C13.95 8.84529 13.5625 9.6209 13.5625 10.4166V12.3038H16.3359L15.8926 15.2121H13.5625V22.2427C18.3432 21.4879 22 17.3257 22 12.3038Z" fill="currentColor"/>
                                    </svg>
                                    <span style="font-size: 14px;" class="ml-2">Facebook</span>
                                </a>

                                <a onclick="copyToClipboardInstagram()" target="_blank" class="hover:brightness-80"
                                    style="background-color: #d3d3d36b;border-radius: 30px;padding: 12px;">
                               <svg class="w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.75 2C4.57436 2 2 4.57436 2 7.75V16.25C2 19.4256 4.57436 22 7.75 22H16.25C19.4256 22 22 19.4256 22 16.25V7.75C22 4.57436 19.4256 2 16.25 2H7.75ZM12 7C14.7614 7 17 9.23858 17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7ZM18 5.5C18.5523 5.5 19 5.94772 19 6.5C19 7.05228 18.5523 7.5 18 7.5C17.4477 7.5 17 7.05228 17 6.5C17 5.94772 17.4477 5.5 18 5.5Z" fill="currentColor"/>
                                   </svg>

                                    <span style="font-size: 14px;" class="ml-2">Instagram</span>
                                </a>

                                <a onclick="copyToClipboardYoutube()" target="_blank" class="hover:brightness-80"
                                    style="background-color: #d3d3d36b;border-radius: 30px;padding: 12px;">
                                    <svg class="w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.8 8.00156C21.662 7.45156 21.313 6.95156 20.812 6.60156C20.19 6.15156 16 6.00156 12 6.00156C8 6.00156 3.81 6.15156 3.188 6.60156C2.687 6.95156 2.338 7.45156 2.2 8.00156C2 9.00156 2 12.0016 2 12.0016C2 12.0016 2 15.0016 2.2 16.0016C2.338 16.5516 2.687 17.0516 3.188 17.4016C3.81 17.8516 8 18.0016 12 18.0016C16 18.0016 20.19 17.8516 20.812 17.4016C21.313 17.0516 21.662 16.5516 21.8 16.0016C22 15.0016 22 12.0016 22 12.0016C22 12.0016 22 9.00156 21.8 8.00156ZM10 15.0016V9.00156L15 12.0016L10 15.0016Z" fill="currentColor"/>
                                                </svg>

                                    <span style="font-size: 14px;" class="ml-2">Youtube</span>
                                </a>
                                </div>

                            </div> 


                            <script>
                            function copyToClipboardInstagram() {
                                navigator.clipboard.writeText(window.location.href)
                                    .then(() => alert("Blog link copied! Paste it in your Instagram bio or story."))
                                    .catch(err => alert("Failed to copy link"));
                            }

                            function copyToClipboardYoutube() {
                                navigator.clipboard.writeText(window.location.href)
                                    .then(() => alert("Blog link copied! Paste it in your Youtube bio or story."))
                                    .catch(err => alert("Failed to copy link"));
                            }

                            </script>

                            <!-- <div class="flex items-center gap-4 mb-4">
                                <h2 class="text-2xl font-bold font-din-next-stencil"><?php #echo esc_html($category_name); ?></h2>
                                <p class="text-sm font-semibold"></p>
                            </div> -->
                        </div>

                    </div>
                    <div style="flex-grow: 3;">
                        <div class="mb-8">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', ['class' => 'w-full h-150 object-cover object-center']);
                            } else {
                                $default_image = get_field('default_blog_post_feature_image', 'option');
                                if ($default_image) {
                                    echo '<img src="' . esc_url($default_image) . '" alt="' . esc_attr(get_the_title()) . '" class="w-full h-150 object-cover object-center">';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                                

                <!--  -->
                
                <!-- <div class="flex flex-wrap justify-between items-center gap-6">
                    <div class="flex gap-8 lg:gap-12">
                        <div>
                            <p class="mb-2">Written by</p>
                            <p class="font-medium"><?php //echo get_the_author(); ?></p>
                        </div>
                        <div>
                            <p class="mb-2">Published on</p>
                            <p class="font-medium"><?php //echo get_the_date('d F Y'); ?></p>
                        </div>
                    </div>
                    <ul x-data="share()" class="flex flex-wrap justify-center items-center gap-4">
                        <li>
                            <button x-on:click="systemShare()" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 16.08C17.24 16.08 16.56 16.38 16.04 16.85L8.91 12.7C8.96 12.47 9 12.24 9 12C9 11.76 8.96 11.53 8.91 11.3L15.96 7.19C16.5 7.69 17.21 8 18 8C19.66 8 21 6.66 21 5C21 3.34 19.66 2 18 2C16.34 2 15 3.34 15 5C15 5.24 15.04 5.47 15.09 5.7L8.04 9.81C7.5 9.31 6.79 9 6 9C4.34 9 3 10.34 3 12C3 13.66 4.34 15 6 15C6.79 15 7.5 14.69 8.04 14.19L15.16 18.35C15.11 18.56 15.08 18.78 15.08 19C15.08 20.61 16.39 21.92 18 21.92C19.61 21.92 20.92 20.61 20.92 19C20.92 17.39 19.61 16.08 18 16.08Z" fill="currentColor"/>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <a x-bind:href="linkedinUrl" target="_blank" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 3.24268C3.67157 3.24268 3 3.91425 3 4.74268V19.7427C3 20.5711 3.67157 21.2427 4.5 21.2427H19.5C20.3284 21.2427 21 20.5711 21 19.7427V4.74268C21 3.91425 20.3284 3.24268 19.5 3.24268H4.5ZM8.52076 7.2454C8.52639 8.20165 7.81061 8.79087 6.96123 8.78665C6.16107 8.78243 5.46357 8.1454 5.46779 7.24681C5.47201 6.40165 6.13998 5.72243 7.00764 5.74212C7.88795 5.76181 8.52639 6.40728 8.52076 7.2454ZM12.2797 10.0044H9.75971H9.7583V18.5643H12.4217V18.3646C12.4217 17.9847 12.4214 17.6047 12.4211 17.2246C12.4203 16.2108 12.4194 15.1959 12.4246 14.1824C12.426 13.9363 12.4372 13.6804 12.5005 13.4455C12.7381 12.568 13.5271 12.0013 14.4074 12.1406C14.9727 12.2291 15.3467 12.5568 15.5042 13.0898C15.6013 13.423 15.6449 13.7816 15.6491 14.129C15.6605 15.1766 15.6589 16.2242 15.6573 17.2719C15.6567 17.6417 15.6561 18.0117 15.6561 18.3815V18.5629H18.328V18.3576C18.328 17.9056 18.3278 17.4537 18.3275 17.0018C18.327 15.8723 18.3264 14.7428 18.3294 13.6129C18.3308 13.1024 18.276 12.599 18.1508 12.1054C17.9638 11.3713 17.5771 10.7638 16.9485 10.3251C16.5027 10.0129 16.0133 9.81178 15.4663 9.78928C15.404 9.78669 15.3412 9.7833 15.2781 9.77989C14.9984 9.76477 14.7141 9.74941 14.4467 9.80334C13.6817 9.95662 13.0096 10.3068 12.5019 10.9241C12.4429 10.9949 12.3852 11.0668 12.2991 11.1741L12.2797 11.1984V10.0044ZM5.68164 18.5671H8.33242V10.01H5.68164V18.5671Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a x-bind:href="twitterUrl" target="_blank" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.1761 4.24268H19.9362L13.9061 11.0201L21 20.2427H15.4456L11.0951 14.6493L6.11723 20.2427H3.35544L9.80517 12.9935L3 4.24268H8.69545L12.6279 9.3553L17.1761 4.24268ZM16.2073 18.6181H17.7368L7.86441 5.78196H6.2232L16.2073 18.6181Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a x-bind:href="facebookUrl" target="_blank" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 12.3038C22 6.74719 17.5229 2.24268 12 2.24268C6.47715 2.24268 2 6.74719 2 12.3038C2 17.3255 5.65684 21.4879 10.4375 22.2427V15.2121H7.89844V12.3038H10.4375V10.0872C10.4375 7.56564 11.9305 6.1728 14.2146 6.1728C15.3088 6.1728 16.4531 6.36931 16.4531 6.36931V8.84529H15.1922C13.95 8.84529 13.5625 9.6209 13.5625 10.4166V12.3038H16.3359L15.8926 15.2121H13.5625V22.2427C18.3432 21.4879 22 17.3257 22 12.3038Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </header>
        <?php
    }
} 