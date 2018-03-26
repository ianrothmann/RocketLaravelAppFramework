<?php
$name=View::getSection('pagetitle');
$breadcrumbs=Rocket::breadcrumbs()->getBreadcrumbs();
$breadcrumbsCount=0;
$currentUrl=url()->current();
$currentKey=md5($currentUrl);
?>
@if(Rocket::breadcrumbs()->shouldBreadcrumbsBeDisplayedForCurrentRoute())
<v-breadcrumbs divider="/">
    @foreach($breadcrumbs as $key=>$breadcrumb)
        @if($currentKey!==$key)
        <v-breadcrumbs-item @click.native="$navigate('{{$breadcrumb['url']}}')">
            {{$breadcrumb['name']}}
        </v-breadcrumbs-item>
        <?php
        $breadcrumbsCount++;
        ?>
        @endif
    @endforeach
    @if($breadcrumbsCount>0)
    <v-breadcrumbs-item :disabled="true">
        {{$name or 'Current'}}
    </v-breadcrumbs-item>
    @endif
</v-breadcrumbs>
@endif
    <?php
    if($name!=''){
        Rocket::breadcrumbs()->addBreadcrumb($name);
    }
    ?>
