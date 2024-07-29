import React from 'react';
import ReactDOM from 'react-dom/client';
import Webcam from "react-webcam";

function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <Webcam/>
            </div>
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
