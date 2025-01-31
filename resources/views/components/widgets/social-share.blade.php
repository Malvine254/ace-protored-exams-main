@props(['title', 'description', 'slug', 'img'])

@php
    $siteUrl = config('app.url') ?: 'https://rnstudentresources.com';
    $shareUrl = $siteUrl . '/' . $slug;

    $fbShareLink = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($shareUrl) . '&quote=' . $title;
    $twitterShareLink = 'https://twitter.com/share?url=' . urlencode($shareUrl) . '&text=' . $title;
    $linkedinShareLink = 'https://linkedin.com/shareArticle?url=' . urlencode($shareUrl) . '&title=' . $title;
@endphp

<div class="block w-full mt-6">
    <h3 class="mb-4 uppercase">Share</h3>
    <div class="flex flex-wrap">
        <a href="#" onclick="openLink('{{ $fbShareLink }}')">
            <x-icon-facebook
                class=" bg-blue-200 p-3 hover:bg-blue-700 hover:text-white rounded h-8 box-content mr-3 mb-3" />
        </a>
        <a href="#" onclick="openLink('{{ $twitterShareLink }}')">
            <x-icon-twitter
                class=" bg-blue-200 p-3 hover:bg-blue-700 hover:text-white rounded h-8 box-content mr-3 mb-3" />
        </a>
        <a href="#" onclick="openLink('{{ $linkedinShareLink }}')">
            <x-icon-linkedin
                class=" bg-blue-200 p-3 hover:bg-blue-700 hover:text-white rounded h-8 box-content mr-3 mb-3" />
        </a>
        <a href="mailto:?subject={{ $title }}&body={{ $shareUrl }}">
            <x-icon-mail
                class=" bg-blue-200 p-3 hover:bg-blue-700 hover:text-white rounded h-8 box-content mr-3 mb-3" />
        </a>
    </div>
</div>

<script>
    function openLink(link) {
        window.open(
            link,
            '_blank',
            'location=yes,height=400,width=400,scrollbars=yes,status=yes'
        );
    }
</script>
