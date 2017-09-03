<?php

function getEditableTranslation($languageLine,$html=false){

    if(\IanRothmann\RocketLaravelAppFramework\Facades\Rocket::isInLanguageEditMode()){
        return '<rocket-editinplace :html="'.($html?'true':'false').'" url="'.route('rocket.language.save').'" locale="'.App::getLocale().'" line="'.$languageLine.'">'.trans($languageLine).'</rocket-editinplace>';
    }else{
        return trans($languageLine);
    }

}