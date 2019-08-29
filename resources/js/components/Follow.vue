<template>
    <div class="follow_area">
        <dl class="follow_unit">
            <div class="follow_box">
                <dt>フォロー</dt>
                <dd>{{ countFollow }}</dd>
            </div>
            <div class="follow_box">
                <dt>フォロワー</dt>
                <dd>{{ countFollower }}</dd>
            </div>
        </dl>
        <div class="follow_btn">
            <button v-if="!followed" class="fol" type="button" name="button" @click="fol(follow)">フォローする</button>
            <button v-else class="unfol" type="button" name="button" @click="unfol(follow)">フォローはずす</button>
        </div><!-- /.follow_btn -->
    </div>
</template>

<script>
    export default {
        props: ['follow', 'follower', 'defaultFollowed', 'followCount', 'followerCount', 'followUserCount'],
        data: function(){
            return{
                followed: false,
                countFollow: this.followCount,
                countFollower: this.followerCount,
                countUserFollow: this.followUserCount,
            }
        },
        created: function(){
            this.followed = this.defaultFollowed;
        },
        methods: {
            fol(follow) {
                let url = `/api/follows/follow`
                axios.post(url,{
                    follow: this.follow,
                    follower: this.follower,
                    followerCount: this.countFollower + 1,
                    followUserCount: this.countUserFollow + 1,
                })
                .then(response => {
                    this.followed = true;
                    this.countFollower = this.countFollower + 1;
                    this.countUserFollow = this.countUserFollow + 1;
                })
                .catch(error => {
                    alert(error)
                });
            },
            unfol(follow) {
                let url = `/api/follows/unfollow`
                axios.post(url,{
                    follow: this.follow,
                    follower: this.follower,
                    followerCount: this.countFollower - 1,
                    followUserCount: this.countUserFollow - 1,
                })
                .then(response => {
                    this.followed = false;
                    this.countFollower = this.countFollower - 1;
                    this.countUserFollow = this.countUserFollow - 1;
                })
                .catch(error => {
                    alert(error)
                });
            }
        }
    }
</script>
