<?php

class Blog_Content {
    public static function render() {

        
        ?>
        <section>
            <div>
                <div class="prose mx-auto">
                    <div>
                        <?php the_content(); ?>
                    </div>
                    

                    <div class="share-post pt-8">
                        <div style ="max-width:1356px;margin:auto;">

                    
                        <div class="flex flex-wrap gap-2 justify-center">
                            <p class="text-xl" style="align-self:center">Share this post</p>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="hover:brightness-80"
                            style="background-color: #d3d3d36b;border-radius: 30px;padding: 12px;">
                            <svg class="w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 12.3038C22 6.74719 17.5229 2.24268 12 2.24268C6.47715 2.24268 2 6.74719 2 12.3038C2 17.3255 5.65684 21.4879 10.4375 22.2427V15.2121H7.89844V12.3038H10.4375V10.0872C10.4375 7.56564 11.9305 6.1728 14.2146 6.1728C15.3088 6.1728 16.4531 6.36931 16.4531 6.36931V8.84529H15.1922C13.95 8.84529 13.5625 9.6209 13.5625 10.4166V12.3038H16.3359L15.8926 15.2121H13.5625V22.2427C18.3432 21.4879 22 17.3257 22 12.3038Z" fill="currentColor"/>
                            </svg>
                            <span class="ml-2">Facebook</span>
                        </a>

                        <a onclick="copyToClipboardInstagram()" target="_blank" class="hover:brightness-80"
                            style="background-color: #d3d3d36b;border-radius: 30px;padding: 12px;">
                          <svg class="w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M7.75 2C4.57436 2 2 4.57436 2 7.75V16.25C2 19.4256 4.57436 22 7.75 22H16.25C19.4256 22 22 19.4256 22 16.25V7.75C22 4.57436 19.4256 2 16.25 2H7.75ZM12 7C14.7614 7 17 9.23858 17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7ZM18 5.5C18.5523 5.5 19 5.94772 19 6.5C19 7.05228 18.5523 7.5 18 7.5C17.4477 7.5 17 7.05228 17 6.5C17 5.94772 17.4477 5.5 18 5.5Z" fill="currentColor"/>
                                </svg>

                            <span class="ml-2">Instagram</span>
                        </a>

                        <a onclick="copyToClipboardYoutube()" target="_blank" class="hover:brightness-80"
                            style="background-color: #d3d3d36b;border-radius: 30px;padding: 12px;">
                            <svg class="w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.8 8.00156C21.662 7.45156 21.313 6.95156 20.812 6.60156C20.19 6.15156 16 6.00156 12 6.00156C8 6.00156 3.81 6.15156 3.188 6.60156C2.687 6.95156 2.338 7.45156 2.2 8.00156C2 9.00156 2 12.0016 2 12.0016C2 12.0016 2 15.0016 2.2 16.0016C2.338 16.5516 2.687 17.0516 3.188 17.4016C3.81 17.8516 8 18.0016 12 18.0016C16 18.0016 20.19 17.8516 20.812 17.4016C21.313 17.0516 21.662 16.5516 21.8 16.0016C22 15.0016 22 12.0016 22 12.0016C22 12.0016 22 9.00156 21.8 8.00156ZM10 15.0016V9.00156L15 12.0016L10 15.0016Z" fill="currentColor"/>
                                    </svg>

                            <span class="ml-2">Youtube</span>
                        </a>
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

                        <hr  class="mt-8"/>

                    </div> 
                </div>
                </div>
            </div>
        </section>
        <?php
    }
} 