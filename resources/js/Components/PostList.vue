<script setup>
import JetNavLink from '@/Jetstream/NavLink.vue';
</script>

<template>
    <div>
        <div class="hidden space-x-8 my-4 sm:flex justify-center">
            <JetNavLink :href="route('posts.index')" :active="route().current('posts.index')">
                <div>投稿一覧</div>
            </JetNavLink>
            <JetNavLink :href="route('mypost')" :active="route().current('mypost')">
                <div>自分の投稿</div>
            </JetNavLink>
            <JetNavLink :href="route('posts.create')" :active="route().current('posts.create')">
                <div>投稿する</div>
            </JetNavLink>
            <JetNavLink :href="route('favorite.index')" :active="route().current('favorite.index')">
                <div>お気に入り一覧</div>
            </JetNavLink>
        </div>
    </div>

    <div>
        <div class="sm:hidden space-x-8 my-4 flex justify-center">
            <JetNavLink :href="route('posts.index')" :active="route().current('posts.index')">
               <div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v2zm1-5a1 1 0 0 1 0-2 5 5 0 0 1 5 5v2a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3zm-2-4a1 1 0 0 1 0-2 3 3 0 0 0 0-6 1 1 0 0 1 0-2 5 5 0 0 1 0 10z"/></svg></div>
            </JetNavLink>
            <JetNavLink :href="route('mypost')" :active="route().current('mypost')">
                 <div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/></svg></div>
            </JetNavLink>
            <JetNavLink :href="route('posts.create')" :active="route().current('posts.create')">
                <div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-9h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H9a1 1 0 0 1 0-2h2V9a1 1 0 0 1 2 0v2z"/></svg></div>
            </JetNavLink>
            <JetNavLink :href="route('favorite.index')" :active="route().current('favorite.index')">
                <div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"/></svg></div>
            </JetNavLink>
        </div>
    </div>

</template>

<style scoped>
</style>
