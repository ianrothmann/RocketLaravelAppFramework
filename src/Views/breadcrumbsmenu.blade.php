<?php
$name=View::getSection('pagetitle');
$breadcrumbs=Rocket::breadcrumbs()->getBreadcrumbs();
$breadcrumbsCount=0;
$currentUrl=url()->current();
$currentKey=md5($currentUrl);
foreach ($breadcrumbs as $key => $breadcrumb){
    if($currentKey!==$key){
        $breadcrumbsCount++;
    }
}
?>
@if(Rocket::breadcrumbs()->shouldBreadcrumbsBeDisplayedForCurrentRoute() && $breadcrumbsCount > 0)
<v-tooltip left>
    <v-menu offset-y slot="activator" left>
        <v-btn flat icon slot="activator"><v-icon>history</v-icon></v-btn>
        <v-card>
            <v-list>
                @foreach($breadcrumbs as $key=>$breadcrumb)
                    @if($currentKey!==$key)
                        <v-list-tile @click="$navigate('{{$breadcrumb['url']}}')">
                            <v-list-tile-content>
                                <v-list-tile-title>{{$breadcrumb['name']}}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    @endif
                @endforeach
            </v-list>
        </v-card>
    </v-menu>
    <span>History</span>
</v-tooltip>
@endif
    <?php
    if($name!=''){
        Rocket::breadcrumbs()->addBreadcrumb($name);
    }
    ?>
