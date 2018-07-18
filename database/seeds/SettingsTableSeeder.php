<?php

use Illuminate\Database\Seeder;
use Seasonofjubilee\Models\Setting;
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = new Setting();
        $settings->key = 'site_title';
        $settings->display_name = "Site Title";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 1;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'site_description';
        $settings->display_name = "Site Description";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text_area";
        $settings->order = 2;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'site_keywords';
        $settings->display_name = "Keywords for this site";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 36;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'site_logo';
        $settings->display_name = "Site Logo (png only 128X45)";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['width'=>128,'height'=>45]]);
        $settings->type = "image";
        $settings->order = "3";
        $settings->save();

        $settings = new Setting();
        $settings->key = 'site_loader';
        $settings->display_name = "Site Loader (gif only 201x201)";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['width'=>201,'height'=>201]]);
        $settings->type = "image";
        $settings->order = "4";
        $settings->save();

        $settings = new Setting();
        $settings->key = 'admin_title';
        $settings->display_name = "Admin Title";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 5;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'admin_description';
        $settings->display_name = "Admin Description";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text_area";
        $settings->order = 6;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'site_favcon';
        $settings->display_name = "Site Favcon (ico or png 24X24)";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['width'=>24,'height'=>24]]);;
        $settings->type = "image";
        $settings->order = 7;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'google_analyst_cliend_id';
        $settings->display_name = "Google Analysts Client ID";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 8;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'first_slider';
        $settings->display_name = "First Home Page Slider 1600X1200";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['width'=>1600,'height'=>1200]]);
        $settings->type = "image";
        $settings->order = 9;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'second_slider';
        $settings->display_name = "Second Home Page Slider 1600X1200";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['width'=>1600,'height'=>1200]]);
        $settings->type = "image";
        $settings->order = 10;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'third_slider';
        $settings->display_name = "Third Home Page Slider 1600X1200";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['width'=>1600,'height'=>1200]]);
        $settings->type = "image";
        $settings->order = 11;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'church_name';
        $settings->display_name = "Church Full Name";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 37;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'church_service_days';
        $settings->display_name = "Church Service days";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "rich_text_box";
        $settings->order = 39;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'about';
        $settings->display_name = "About Church site";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "rich_text_box";
        $settings->order = 13;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'vision';
        $settings->display_name = "Organization Vision";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text_area";
        $settings->order = 22;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'mission';
        $settings->display_name = "Organization Mission";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text_area";
        $settings->order = 23;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'purpose';
        $settings->display_name = "Organization Purpose";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text_area";
        $settings->order = 24;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'believe';
        $settings->display_name = "Organization Believe";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text_area";
        $settings->order = 25;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'pastor_name';
        $settings->display_name = "Name of General Overseer";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 27;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'go';
        $settings->display_name = "About Our Pastor";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "rich_text_box";
        $settings->order = 25;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'pastor_photo';
        $settings->display_name = "Pastor's Photo";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "image";
        $settings->order = 26;
        $settings->save();



        $settings = new Setting();
        $settings->key = 'address';
        $settings->display_name = "Organization Address";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 14;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'phone';
        $settings->display_name = "Organization Phone Number";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "rich_text_box";
        $settings->order = 15;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'email_address';
        $settings->display_name = "Organization Email Address";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 16;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'twitter_address';
        $settings->display_name = "Twitter Address";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 17;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'facebook_address';
        $settings->display_name = "Facebook Address";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 18;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'instagram_address';
        $settings->display_name = "Instagram Address";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 19;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'google+_address';
        $settings->display_name = "Google plus Address";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 20;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'pinterest_address';
        $settings->display_name = "Pinterest Address";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "text";
        $settings->order = 21;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'about_page_photo';
        $settings->display_name = "About Page header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 28;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'contact_page_photo';
        $settings->display_name = "Contact Page header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 29;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'sermon_page_photo';
        $settings->display_name = "Sermon Page header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 30;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'event_page_photo';
        $settings->display_name = "Event Page header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 31;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'blog_page_photo';
        $settings->display_name = "Blog Page header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 32;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'testimony_page_photo';
        $settings->display_name = "Testimony Page header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 33;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'media_page_photo';
        $settings->display_name = "Media Page header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 34;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'other_pages_photo';
        $settings->display_name = "Other Pages header Image 1920X500";
        $settings->value= "";
        $settings->details = json_encode(['resize'=>['height'=>1920,'width'=>500]]);
        $settings->type = "image";
        $settings->order = 35;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'homepage_sermon_photo';
        $settings->display_name = "Home Page Sermon background 1600X808";
        $settings->value= "";
        $settings->details = json_encode(['thumbnails'=>['name'=>'','scale'=>'','crop'=>['width'=>1600,'height'=>500]]]);
        $settings->type = "image";
        $settings->order = 40;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'homepage_testimony_photo';
        $settings->display_name = "Home Page testimony background 1920X995";
        $settings->value= "";
        $settings->details = json_encode(['thumbnails'=>['name'=>'','scale'=>'','crop'=>['width'=>1600,'height'=>500]]]);
        $settings->type = "image";
        $settings->order = 41;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'homepage_about_photo';
        $settings->display_name = "Home Page About background 791X547";
        $settings->value= "";
        $settings->details = json_encode(['thumbnails'=>['name'=>'','scale'=>'','crop'=>['width'=>1600,'height'=>500]]]);
        $settings->type = "image";
        $settings->order = 12;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'church_branches';
        $settings->display_name = "Church Branches";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "rich_text_box";
        $settings->order = 38;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'church_bank_details';
        $settings->display_name = "Church Bank Details";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "rich_text_box";
        $settings->order = 41;
        $settings->save();

        $settings = new Setting();
        $settings->key = 'prayer_request_phones';
        $settings->display_name = "Prayer Request Phone Number";
        $settings->value= "";
        $settings->details = "";
        $settings->type = "rich_text_box";
        $settings->order = 42;
        $settings->save();

    }
}
