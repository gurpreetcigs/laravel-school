import React from 'react';
import ReactDOM from 'react-dom';
import { Player, ControlBar } from 'video-react';


function VideoPlayer(props) {
  return (
    <Player
     autoPlay
    >
      <source src={props.url} />
      <ControlBar autoHide={false} />
    </Player>
  );
}


export default VideoPlayer;

if (document.getElementById('video-player')) {
  let element = document.getElementById('video-player')
  // elements[i].style ...
  const props = Object.assign({}, element.dataset)
  ReactDOM.render(<VideoPlayer { ...props }/>, document.getElementById('video-player'));
}
