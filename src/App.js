import logo from './logo.svg';
import './App.css';
import Header from './Widgets/Header';
import Content from './Widgets/Content';
import Footer from './Widgets/Footer';
import DragAndDrop from './Modules/DragAndDrop';

function App() {
  return (
    <div>
      {/* <Header></Header>
      <Content></Content>
      <Footer></Footer> */}
      <DragAndDrop />
    </div>
  );
}

export default App;
