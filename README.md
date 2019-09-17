# Incomplete Spotify Player

### Stack
- Laravel 6.0.1
- Vue
- [Spotify API](https://developer.spotify.com/)

## TASKS

#### Pre-task
Fork this repo.
Login to Spotify Developer dashboard and create new App. Then you will get `client id` and `client secret` which you have to use in the project
You can run [docker](https://www.docker.com/) for this project. [Doker Compose](https://docs.docker.com/compose/) yml file already created in a repo so you can use it. You can you any other way to make project work

#### 1. Implement simple player which start/stop current song, next and previous song features
Frontend is calling: 

| route | function |
| --- | --- |
| /v1/player/pause | pause |
| /v1/player/pause | play |
| /v1/player/next | next song |
| /v1/player/previous | previous song |

#### 2. Implement same simple player as it is in #1 without using Database (if possible. If not, explain why)

#### 3. Implement User Playlists

#### 4. Implement Album view

#### 6. Implement any other API somehow related to Spotify

#### 7. Implement anything else you think it's cool!

Write clean, easy to understand code. explain clearly in comments some hard to understand code or why some function might not work (i.e. Spotify requirements)

## Expectations

We expect you:
1. to write clean, simple and correct code
2. to leave code behind you much better than before (don't be afraid to change things)
3. to use Pull Request (PR) for each task
4. to understand existing code
5. to always keep in mind the security
6. to understand documentation and be able to use it correctly
