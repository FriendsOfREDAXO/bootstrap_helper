<?php

// this modul input uses the mform addon
// this modul input uses the mblock addon

if(rex_addon::get('mform')->isAvailable() && rex_addon::get('mblock')->isAvailable() && rex::isBackend()) {
    echo '<p>YAY!</p>';
    // base ID
    $id = 1;

    // init mform
    $mform = new MForm();

    // Config Tab
    $mform->addTab('Einstellungen');

    // Grid Layout Fieldset
    $mform->addFieldset('Grid Layout',array('class'=> 'grid_layout'));
    //$mform->addHeadline('Grid Layout', array('class'=>'text-center'));
    //variable grid_layout
    $grid_layout = [
        //one column
        '12'      => '<i class="grid_12"></i>',

        //two column
        '12_1'    => '<i class="grid_12_1"></i>',
        '1_11'    => '<i class="grid_1_11"></i>',
        '2_10'    => '<i class="grid_2_10"></i>',
        '3_9'     => '<i class="grid_3_9"></i>',
        '4_8'     => '<i class="grid_4_8"></i>',
        '5_7'     => '<i class="grid_5_7"></i>',
        '6_6'     => '<i class="grid_6_6"></i>',
        '7_5'     => '<i class="grid_7_5"></i>',
        '8_4'     => '<i class="grid_8_4"></i>',
        '9_3'     => '<i class="grid_9_3"></i>',
        '10_2'    => '<i class="grid_10_2"></i>',
        '11_1'    => '<i class="grid_11_1"></i>',

        //three column
        '1_10_1'  => '<i class="grid_1_10_1"></i>',
        '2_8_2'   => '<i class="grid_2_8_2"></i>',
        '3_6_3'   => '<i class="grid_3_6_3"></i>',
        '4_4_4'   => '<i class="grid_4_4_4"></i>',
        '5_2_5'   => '<i class="grid_5_2_5"></i>',
        '1_1_10'  => '<i class="grid_1_1_10"></i>',
        '10_1_1'  => '<i class="grid_10_1_1"></i>',
        '1_2_9'   => '<i class="grid_1_2_9"></i>',
        '9_2_1'   => '<i class="grid_9_2_1"></i>',
        '2_2_8'   => '<i class="grid_2_2_8"></i>',
        '8_2_2'   => '<i class="grid_8_2_2"></i>',
        '3_3_6'   => '<i class="grid_3_3_6"></i>',
        '6_3_3'   => '<i class="grid_6_3_3"></i>',

        //four column
        '1_1_1_9' => '<i class="grid_1_1_1_9"></i>',
        '2_1_1_8' => '<i class="grid_2_1_1_8"></i>',
        '1_2_1_8' => '<i class="grid_1_2_1_8"></i>',
        '1_1_2_8' => '<i class="grid_1_1_2_8"></i>',
        '1_2_2_7' => '<i class="grid_1_2_2_7"></i>',
        '2_1_2_7' => '<i class="grid_2_1_2_7"></i>',
        '2_2_1_7' => '<i class="grid_2_2_1_7"></i>',
        '2_2_2_6' => '<i class="grid_2_2_2_6"></i>',
        '2_2_3_5' => '<i class="grid_2_2_3_5"></i>',
        '2_3_2_5' => '<i class="grid_2_3_2_5"></i>',
        '3_2_2_5' => '<i class="grid_3_2_2_5"></i>',
        '3_2_3_4' => '<i class="grid_3_2_3_4"></i>',
        '3_3_2_4' => '<i class="grid_3_3_2_4"></i>',
        '3_3_3_3' => '<i class="grid_3_3_3_3"></i>',

        '9_1_1_1' => '<i class="grid_9_1_1_1"></i>',
        '8_1_1_2' => '<i class="grid_8_1_1_2"></i>',
        '8_1_2_1' => '<i class="grid_8_1_2_1"></i>',
        '8_2_1_1' => '<i class="grid_8_2_1_1"></i>',
        '7_2_2_1' => '<i class="grid_7_2_2_1"></i>',
        '7_2_1_2' => '<i class="grid_7_2_1_2"></i>',
        '7_1_2_2' => '<i class="grid_7_1_2_2"></i>',
        '6_2_2_2' => '<i class="grid_6_2_2_2"></i>',
        '5_3_2_2' => '<i class="grid_5_3_2_2"></i>',
        '5_2_3_2' => '<i class="grid_5_2_3_2"></i>',
        '5_2_2_3' => '<i class="grid_5_2_2_3"></i>',
        '4_3_2_3' => '<i class="grid_4_3_2_3"></i>',
        '4_2_3_3' => '<i class="grid_4_2_3_3"></i>'
    ];

    $mform->addRadioField("$id.0.grid_layout",$grid_layout,array('label'=>'Grid Layout','class'=>'grid_layout'));

    //Config Inputs
    $mform->addFieldset('Weitere Einstellungen',array('class'=>'configs'));

    $mform->addHeadline('Klassen und ID');

    $mform->addHtml('<div class="row">');
    $mform->addHtml('<div class="col-sm-7">');
    //Class(es)
    $mform->addTextField("$id.0.class", array('label'=>'Klasse(n)','class'=>'selectize'));
    $mform->addHtml('</div>');

    $mform->addHtml('<div class="col-sm-5">');
    //ID
    $mform->addTextField("$id.0.id", array('label'=>'ID'));
    $mform->addHtml('</div>');
    $mform->addHtml('</div>');

    $mform->addHeadline('Padding');
    $mform->addDescription('Padding vergrößert den Abstand innerhalb des Elements. Die Angaben sind mit Maßen zu setzen, z.B. px, %, etc.');

    $mform->addHtml('<div class="row">');
    $mform->addHtml('<div class="col-sm-3">');
    //Padding Top
    $mform->addTextField("$id.0.padding-top", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-up"></i></span>'));
    $mform->addHtml('</div>');

    $mform->addHtml('<div class="col-sm-3">');
    //Padding Right
    $mform->addTextField("$id.0.padding-right", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-right"></i></span>'));
    $mform->addHtml('</div>');

    $mform->addHtml('<div class="col-sm-3">');
    //Padding Bottom
    $mform->addTextField("$id.0.padding-bottom", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-down"></i></span>'));
    $mform->addHtml('</div>');

    $mform->addHtml('<div class="col-sm-3">');
    //Padding Left
    $mform->addTextField("$id.0.padding-left", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-left"></i></span>'));
    $mform->addHtml('</div>');
    $mform->addHtml('</div>');

    $mform->addHeadline('Margin');
    $mform->addDescription('Margin vergrößert den Abstand außerhalb des Elements. Die Angaben sind mit Maßen zu setzen, z.B. px, %, etc.');

    $mform->addHtml('<div class="row">');
    $mform->addHtml('<div class="col-sm-3">');
    //Margin Top
    $mform->addTextField("$id.0.margin-top", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-up"></i></span>'));
    $mform->addHtml('</div>');

    $mform->addHtml('<div class="col-sm-3">');
    //Margin Right
    $mform->addTextField("$id.0.margin-right", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-right"></i></span>'));
    $mform->addHtml('</div>');

    $mform->addHtml('<div class="col-sm-3">');
    //Margin Bottom
    $mform->addTextField("$id.0.margin-bottom", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-down"></i></span>'));
    $mform->addHtml('</div>');

    $mform->addHtml('<div class="col-sm-3">');
    //Margin Left
    $mform->addTextField("$id.0.margin-left", array('label'=>'<span class="text-center"><i class="fa fa-fw fa-arrow-left"></i></span>'));
    $mform->addHtml('</div>');
    $mform->addHtml('</div>');

    $mform->addHeadline('Farben und Hintergründe');

    //Text Color
    $mform->addTextField("$id.0.textColor", array('label'=>'Text-Farbe','class'=>'textColor'));

    //Background Color
    $mform->addTextField("$id.0.bgColor", array('label'=>'HG-Farbe','class'=>'bgColor'));

    //Background Image
    $mform->addMediaField("$id.0.bgImage", array('types'=>'gif,jpg,png','preview'=>1,'label'=>'HG-Bild'));

    //Background-Repeat
    $mform->addSelectField("$id.0.bgRepeat",array('no-repeat','repeat', 'repeat-x','repeat-y','round','space','inherit'),array('label'=>'Repeat'));

    //Background-Size
    $mform->addSelectField("$id.0.bgSize",array('auto','cover', 'contain'),array('label'=>'Size'));

    //Background-Position
    $mform->addSelectField("$id.0.bgposition",array('left top','left center', 'left bottom', 'center top', 'center center', 'center bottom', 'right top', 'right center', 'right bottom'),array('label'=>'Position'));

    //$mform->addHeadline('Animation');
    //@ToDo: Needs animation states and how to animate (Waypoint?);


    echo $mform->show();

}
else {
    echo '<div style="padding:15px;" class="bg-danger">Bitte installieren Sie <strong>mform</strong> und / oder <strong>mblock</strong>!</div>';
}

if(rex::isBackend()) { ?>
    <script>
        $(function () {
            $('.selectize').selectize({
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });

            var settings = {
                animationSpeed: 50,
                animationEasing: 'swing',
                change: null,
                changeDelay: 0,
                control: 'hue',
                defaultValue: '',
                format: 'rgb',
                hide: null,
                hideSpeed: 100,
                inline: false,
                keywords: '',
                letterCase: 'lowercase',
                opacity: true,
                position: 'bottom left',
                show: null,
                showSpeed: 100,
                theme: 'bootstrap',
                swatches: []
            };

            $('input.textColor').minicolors(settings);
            $('input.bgColor').minicolors(settings);
        });
    </script>

    <style>
        select.form-control {
            height: 34px;
        }
        .grid_layout .form-group {
            max-width: 680px;
            margin: 0 auto;
        }
        .grid_layout legend {
            text-align: center;
            border-bottom: 0 none;
        }
        .grid_layout .control-label,
        input[type="radio"]
        {
            display: none;
        }
        label input[type="radio"]:checked ~ i[class^='grid_'],
        label input[type="radio"]:checked ~ i[class*='grid_']
        {
            background-color: #3bb594;
        }
        i[class^='grid_']:hover,
        i[class*='grid_']:hover
        {
            background-color: #3bb594;
        }
        .grid_layout .col-sm-10 {
            width: 100%;
        }
        .radio {
            float:left;
        }
        .radio:nth-child(even) {
            float:right;
        }
        .radio label {
            padding-left: 0;
        }
        i[class^='grid_'], i[class*='grid_'] {
            display:block;
            width: 320px;
            height: 60px;
            padding: 10px 20px;
            background-color: #FFF;
            background-size: 280px 40px;
            background-position: 20px 10px;
            background-repeat: no-repeat;
        }
        .grid_12 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_12.png');
        }
        .grid_12_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_12_1.png');
        }

        .grid_1_11 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_11.png');
        }
        .grid_2_10 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_10.png');
        }
        .grid_3_9 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_3_9.png');
        }
        .grid_4_8 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_4_8.png');
        }
        .grid_5_7 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_5_7.png');
        }
        .grid_6_6 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_6_6.png');
        }
        .grid_7_5 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_7_5.png');
        }
        .grid_8_4 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_8_4.png');
        }
        .grid_9_3 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_9_3.png');
        }
        .grid_10_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_10_2.png');
        }
        .grid_11_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_11_1.png');
        }
        .grid_1_10_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_10_1.png');
        }
        .grid_2_8_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_8_2.png');
        }
        .grid_3_6_3 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_3_6_3.png');
        }
        .grid_4_4_4 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_4_4_4.png');
        }
        .grid_5_2_5 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_5_2_5.png');
        }
        .grid_1_1_10 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_1_10.png');
        }
        .grid_10_1_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_10_1_1.png');
        }
        .grid_1_2_9 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_2_9.png');
        }
        .grid_9_2_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_9_2_1.png');
        }
        .grid_2_2_8 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_2_8.png');
        }
        .grid_8_2_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_8_2_2.png');
        }
        .grid_3_3_6 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_3_3_6.png');
        }
        .grid_6_3_3 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_6_3_3.png');
        }
        .grid_1_1_1_9 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_1_1_9.png');
        }
        .grid_2_1_1_8 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_1_1_8.png');
        }
        .grid_1_2_1_8 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_2_1_8.png');
        }
        .grid_1_1_2_8 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_1_2_8.png');
        }
        .grid_1_2_2_7 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_1_2_2_7.png');
        }
        .grid_2_1_2_7 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_1_2_7.png');
        }
        .grid_2_2_1_7 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_2_1_7.png');
        }
        .grid_2_2_2_6 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_2_2_6.png');
        }
        .grid_2_2_3_5 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_2_3_5.png');
        }
        .grid_2_3_2_5 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_2_3_2_5.png');
        }
        .grid_3_2_2_5 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_3_2_2_5.png');
        }
        .grid_3_2_3_4 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_3_2_3_4.png');
        }
        .grid_3_3_2_4 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_3_3_2_4.png');
        }
        .grid_3_3_3_3 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_3_3_3_3.png');
        }
        .grid_9_1_1_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_9_1_1_1.png');
        }
        .grid_8_1_1_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_8_1_1_2.png');
        }
        .grid_8_1_2_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_8_1_2_1.png');
        }
        .grid_8_2_1_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_8_2_1_1.png');
        }
        .grid_7_2_2_1 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_7_2_2_1.png');
        }
        .grid_7_2_1_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_7_2_1_2.png');
        }
        .grid_7_1_2_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_7_1_2_2.png');
        }
        .grid_6_2_2_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_6_2_2_2.png');
        }
        .grid_5_3_2_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_5_3_2_2.png');
        }
        .grid_5_2_3_2 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_5_2_3_2.png');
        }
        .grid_5_2_2_3 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_5_2_2_3.png');
        }
        .grid_4_3_2_3 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_4_3_2_3.png');
        }
        .grid_4_2_3_3 {
            background-image: url('../assets/9001_mblock_mform_ews_module_assets/img/grid_-assets/grid_4_2_3_3.png');
        }

        .mform-headline h3 {
            font-size: 18px !important;
        }
        .form-group.mform-headline,
        .form-group.mform-description {
            margin-left: 0;
            margin-right: 0;
        }
    </style>

<? }