<?php

namespace IanRothmann\RocketLaravelAppFramework\Language;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class RocketLanguage
{
    protected $editMode=false;

    public function __construct(){

    }

    public static function register(){
        Blade::directive('editabletext', function ($languageLine) {
            return "<?php echo getEditableTranslation($languageLine) ?>";
        });

        Blade::directive('editablehtml', function ($languageLine) {
            return "<?php echo getEditableTranslation($languageLine,true) ?>";
        });
    }

    public function isInEditMode(){
        return $this->editMode;
    }

    public function activateEditMode(){
        $this->editMode=true;
    }

    public function deactivateEditMode(){
        $this->editMode=false;
    }

    public function save(Request $request){
        $modelClass=config('translation-loader.model');
        $line=explode('.',$request->get('line'));
        $group=$line[0];
        $key=$line[1];
        $locale=$request->get('locale');
        $content=$request->get('content');
        $languageLine=$modelClass::where('group',$group)->where('key',$key)->first();
        if($languageLine==null){
            $modelClass::create([
                'group' => $group,
                'key' => $key,
                'text' => [$locale => $content],
            ]);
        }else{
            $text=$languageLine->text;
            $text[$locale]=$content;
            $languageLine->text=$text;
            $languageLine->save();
        }
        return $languageLine;
    }
}