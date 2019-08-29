<template>
    <div class="good_btn">
        <button v-if="!liked" class="nomal" type="button" name="button" @click="like(postId)">
            いいね&nbsp;{{ countLike }}
        </button>
        <button v-else class="like" type="button" name="button" @click="unlike(postId)">
            いいね&nbsp;{{ countLike }}
        </button>
    </div><!-- /.good_btn -->
</template>

<script>
    export default {
        props: ['postId', 'userId', 'defaultLiked', 'count'],
        data: function(){
            return{
                liked: false,
                countLike: this.count,
            }
        },
        created: function(){
            this.liked = this.defaultLiked;
        },
        methods: {
            like(postId) {
                let url = `/api/posts/${postId}/like`
                axios.post(url,{
                    user_id: this.userId,
                    count: this.countLike + 1,
                })
                .then(response => {
                    this.liked = true;
                    this.countLike = this.countLike + 1;
                })
                .catch(error => {
                    alert(error)
                });
            },
            unlike(postId) {
                let url = `/api/posts/${postId}/unlike`
                axios.post(url,{
                    user_id: this.userId,
                    count: this.countLike - 1,
                })
                .then(response => {
                    this.liked = false;
                    this.countLike = this.countLike - 1;
                })
                .catch(error => {
                    alert(error)
                });
            }
        }
    }
</script>
