# Video Management Web Application

###### The topic for this project is one of the previously asked questions in rtcamp solutions and this question quite interests me so that's why I created this project to brush up my skills in PHP javascript. I love challenging works that push me to work hard and not give up. it always teaches me so many things while creating projects.

## Project Defination
```
Video Encoding Challenge
This is more like building your own YouTube. 🎥
Please create an interactive JavaScript/React app which has:

1.Upload: Option to upload video in any format. Since videos are large, the uploader should show progress.

2.Convert: On successful upload video, the server-side (PHP) process should encode video into mp4 format in the background. Basically, after the video upload is complete, a user will simply close the browser. But when they come back later they should see video available in multiple formats. You can use FFMPEG to encode videos.

3.Thumbnail: For videos that are successfully converted, display thumbnails like YouTube homepage shows. Once anyone hovers on thumbnails, a small GIF should play automatically so people can see the content of the video without watching the entire video.

4.Watermark: For uploaded video — a user can provide watermark text — give an option for the user to specify text — and use user-provided text to add that in the video as watermark.

```

## My Solution :-

1.Upload Functionality :- <br>
  -> it mentioned that video is large and we need to show progress so that's why i choose javascript to do this work since we can use XMLHttpRequest object for upload and also we can know upload size and progress of upload.
  
[^refer]: ./upload.php
