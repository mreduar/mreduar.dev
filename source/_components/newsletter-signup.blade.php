<div class="flex justify-center lg:-mx-12 my-12 p-6 md:px-12 bg-gradient-to-r from-blacked to-blacked text-sm md:rounded shadow-2xl">
    <!-- Begin Mailchimp Signup Form -->
    <div id="mc_embed_signup">
        <form action="https://gmail.us14.list-manage.com/subscribe/post?u=02a2ac09ace4e2be99b87a378&amp;id=c62fc1badc" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
                <h2>Subscribe to my newsletter</h2>
                <div class="mc-field-group">
                    <label for="mce-EMAIL">Email Address </label>
                    <input type="email" value="" name="EMAIL" class="required email text-gray-900" id="mce-EMAIL" placeholder="Email address">
                </div>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_25582686a9fc051afd5453557_189578c854" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
            <div id="mce-responses" class="clear text-gray-900 inline-block">
                <div class="response" id="mce-success-response" style="display: none;"></div>
                <div class="response" id="mce-error-response" style="display: none;"></div>
            </div>
        </form>
    </div>
    <!--End Mailchimp Signup Form -->
</div>

@push('scripts')
    <script src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
    <script>(function($) {
        window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);
    </script>
@endpush
