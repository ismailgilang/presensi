import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import Webcam from "react-webcam";

function Example() {
    const [imagePreview, setImagePreview] = useState()
    const webcamRef = React.useRef(null);
    const capture = React.useCallback(
    () => {
      const imageSrc = webcamRef.current.getScreenshot();
      setImagePreview(imageSrc)
    },
    [webcamRef]
  );
    return (
        <div className="container">
            <h1>hallo</h1>
            <div className="row justify-content-center">
            <div className="col-4">
            {imagePreview && (
                <img src={imagePreview} alt="" />
            )}
            </div>
            <div className="col-4"></div>
            <div className="col-4"></div>
            </div>
      <Webcam
        audio={false}
        height={720}
        ref={webcamRef}
        screenshotFormat="image/jpeg"
        width={1280}
      />
      <button onClick={capture}>Capture photo</button>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}
