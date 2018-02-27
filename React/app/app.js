import React from 'react';
import ReactDOM from 'react-dom';
import Loading from 'App/loading';
import Datapoint from 'App/datapoint';
import News from 'App/news';

require("Less/all.less");
require("Less/main.less");

export default class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            news: null
        };

        Datapoint.call("getNewsList", {limit: 3}, (data) => {
            this.setState({
                news: data
            });
        });
    }

    render(){
        return (
            <div>
                <header>
                    <h1>Simple Engine</h1>
                    <h2>Framework</h2>
                    <h3>REACTive version</h3>
                </header>

                <main>
                    <a href="/">Back to the multipage version</a>
                    <div className="info">
                        <p>
                            To work with this version you need the last version on node.js. Open the bash there and type "npm install".
                            Then, all the necessary packages should be installed.
                        </p>
                        <p>
                            React components placed into the app folder, and app-less contain the styles.
                            You may start a development server with "npm start"(localhost:8080 by default) and build production version with "npm run build".
                            Index file for development stored in the dev folder. The built "bundle.js" will be stored in the www folder. index-react.html has the basic page for runnig react application.
                            If You want react as your frontend, just replace the index.php with this file.
                        </p>
                        <p>
                            Entry point for getting data from the server is datapoint.php and library datapoint.js is for accessing it. Look at the example of using it next to the description.
                        </p>
                        <p>
                            You may read more about React on <a href="https://reactjs.org/" target="_blank">reactjs.org</a>. Note, that react is only view for your web application. For complex things you need atlist model.
                            In this case, read more about Redux and Flux.
                        </p>
                        <p>
                            Also you should know some things about development server. It's sending POST requests to http://sengine/datapoint.php by default. You may change it in the app/datapoint.js file.
                            It is cross domain request, so, datapoint.php will allow it only on development server. You need to turn this mode on to get the requests work.
                            Add variable DEV_SERVER to your server or edit init.php
                        </p>
                    </div>

                    {
                        this.state.news ?
                            <div>
                                {
                                    this.state.news.map((object, i) => {
                                        return <News data={object} key={i}/>;
                                    })
                                }
                            </div>
                                :
                            <Loading/>
                    }
                </main>
            </div>
        )
    }
};

ReactDOM.render(<App />, document.getElementById('app'));