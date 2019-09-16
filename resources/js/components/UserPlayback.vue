<template>
    <div class="player" :key="timestamp">
        <div class="player__control centered mb-2" v-if="isPremium">
            <div class="player__button" :class="{'player__button--off': !isShuffleOn}">
                <font-awesome-icon icon="random" @click="shuffle" size="xs" />
            </div>
            <div class="player__button">
                <font-awesome-icon icon="step-backward" @click="previous" size="sm" />
            </div>
            <div class="player__button">
                <font-awesome-icon v-if="!isPausingDisallowed" icon="pause-circle" size="lg" @click="pause" />
                <font-awesome-icon v-if="!isResumingDisallowed" icon="play-circle" size="lg" @click="play" />
            </div>
            <div class="player__button">
                <font-awesome-icon icon="step-forward" @click="next" size="sm" />
            </div>
            <div class="player__button" :class="{'player__button--off': !isRepeatOn}">
                <font-awesome-icon icon="redo-alt" @click="repeat" size="xs" />
            </div>
        </div>
        <div v-if="song" class="player__playing text-center">
            <b>{{ song }}</b>
            <small class="d-block">
                <b v-for="(art, artKey) in artists" :key="artKey">
                    <a :href="art.external_urls.spotify" target="_blank">
                        {{ art.name }}
                    </a>
                </b>
            </small>
        </div>
        <div v-if="song" class="player__info">
            on <b>{{device}}</b>
        </div>
        <div v-if="!song">
            <b>Nothing is playing</b>
        </div>
    </div>
</template>

<script>
export default {
    name: "user-playback",
    props: {
        userId: String,
        userPlan: String
    },
    data() {
        return {
            data: {
                context: {},
                currently_playing_type: "track",
                device: {},
                is_playing: false,
                actions: {
                  disallows: {}
                },
                item: {},
                progress_ms: 0,
                repeat_state: "off",
                shuffle_state: false,
                timestamp: 1,
            }
        };
    },
    created() {
        this.load();
    },
    computed: {
        isPremium() {
          return this.userPlan === "premium";
        },
        artists() {
            try {
                return this.data.item.artists;
            } catch (e) {
                return [];
            }
        },
        artist() {
            try {
                return this.data.item.artists[0].name;
            } catch (e) {
                return "";
            }
        },
        artistUrl() {
            try {
                return this.data.item.artists[0].external_urls.spotify;
            } catch (e) {
                return "";
            }
        },
        song() {
            try {
                return this.data.item.name;
            } catch (e) {
                return "";
            }
        },
        device() {
            try {
                return this.data.device.name;
            } catch (e) {
                return "";
            }
        },
        timestamp() {
            return this.data.timestamp;
        },
        isRepeatOn() {
          return this.data.repeat_state === "on"
        },
        isShuffleOn() {
          return this.data.shuffle_state
        },
        isResumingDisallowed() {
          try {
            return this.data.actions.disallows.resuming;
          } catch (e) {
            return false;
          }
        },
        isPausingDisallowed() {
          try {
            return this.data.actions.disallows.pausing;
          } catch (e) {
            return true;
          }
        },
        isPlaying() {
          return this.data.is_playing;
        }
    },
    methods: {
        load(timeout = 0) {
          setTimeout(() => {
            console.log('Load data');
            this.$http
              .get("/v1/player", {
                params: {
                  user: this.userId
                }
              })
              .then(res => {
                this.data = res;
              })
              .catch(e => {
                console.error(e);
              });
          }, timeout*1000);
        },
      pause() {
        console.log('Pause');
        this.$http
          .get("/v1/player/pause", {
            params: {
              user: this.userId
            }
          }).finally(() => {
            this.load(1)
        });
      },
      play() {
        console.log('play');
        this.$http
          .get("/v1/player/play", {
            params: {
              user: this.userId
            }
          }).finally(() => this.load(1));
      },
      next() {
        console.log('next');
        this.$http
          .get("/v1/player/next", {
            params: {
              user: this.userId
            }
          }).finally(() => this.load(1));
      },
      previous() {
        console.log('previous');
        this.$http
          .get("/v1/player/previous", {
            params: {
              user: this.userId
            }
          }).finally(() => this.load(1));
      },
      volume() {
        console.log('volume');
        this.$http
          .get("/v1/player/volume", {
            params: {
              user: this.userId
            }
          }).finally(() => this.load(1));
      },
      shuffle() {
        this.$http
          .get("/v1/player/shuffle", {
            params: {
              user: this.userId,
              state: !this.data.shuffle_state
            }
          }).finally(() => this.load(1));
      },
      repeat() {
        console.log('repeat');
        this.$http
          .get("/v1/player/repeat", {
            params: {
              user: this.userId,
              state: ["track", "context", "off"][0]
            }
          }).finally(() => this.load(1));
      }
    }
};
</script>

<style scoped></style>
