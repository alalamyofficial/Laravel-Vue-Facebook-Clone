import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
      state: {
            posts: [],
            auth_user: {}
      },
      getters: {

            all_posts(state) {
                  return state.posts
            }
      },
      mutations: {

            add_post(state, post) {
                  state.posts.push(post)
            },
            auth_user_data(state, user) {
                  state.auth_user = user
            },
            update_post_likes(state, payload)
            {
                  var post = state.posts.find( (p) => {
                        return p.id === payload.id
                  })

                  post.likes.push(payload.like)
            },
            unlike_post(state, payload) {
                  
                  var post = state.posts.find((p) => {
                        return p.id === payload.post_id
                  })

                  var like = post.likes.find( (l) => {
                        return l.id === payload.like_id
                  })

                  var index = post.likes.indexOf(like)

                  post.likes.splice(index, 1)
            }
      }
})
