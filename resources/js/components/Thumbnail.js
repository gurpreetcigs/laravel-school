import React from 'react';
import ReactDOM from 'react-dom';
import VideoThumbnail from 'react-video-thumbnail';
// react-video-thumbnail
import VideoPlayer from 'simple-react-video-thumbnail'

function Thumbnail(props) {
    return (
        <VideoThumbnail
        videoUrl={props.url}
        thumbnailHandler={(thumbnail) => console.log(thumbnail)}
        />
    )
}

export default Thumbnail;

if (document.getElementsByClassName('thumbnail')) {

    var elements = document.getElementsByClassName("thumbnail");
    for (var i = 0, len = elements.length; i < len; i++) {
        // elements[i].style ...
        const props = Object.assign({}, elements[i].dataset)
        
        ReactDOM.render(<Thumbnail {...props}/>, document.getElementById(`video-${props.name}`));
    }
      
    // create new props object with element's data-attributes
    // result: {tsId: "1241"}
    
}