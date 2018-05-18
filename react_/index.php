<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <script src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script> -->
    <title>React-Directory</title>
</head>
<body>
    <?php 
        require_once('db.php'); 
        $DB = DBobject::DBInstance();
        global $DB;
        require_once('directory.php'); 
        $dr = new NameDirectory('books');
        di($dr->get_all_namedirectory());
        $mysqli = $DB->get_records('SELECT  * FROM books where name like (?)',array('name'=>"'%i%'"));
    ?>
    <div id="react-container"></div>
    <script type="text/babel">

        class Checboox extends React.Component{
            constructor(props){ 
                super(props)
                this.state ={
                    checked: false
                }
                this.handleCheck = this.handleCheck.bind(this)
            }
            handleCheck(){
                this.setState({
                    checked: !this.state.checked
                })
            }
            render(){
                var msg
                if(this.state.checked){
                    msg ='checked'
                }else{
                    msg= 'nope'
                }
                return(
                    <div><input type="checkbox" onChange={this.handleCheck}/>
                    <p>This box {msg} </p>
                    </div>

                )
            }
        }
        ReactDOM.render(
            <Checboox/>,
            document.getElementById('react-container')
        )
    </script>
    
</body>
</html>