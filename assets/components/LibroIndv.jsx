import React, { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom'
import { saveAs } from 'file-saver';

const descargaUrl = `http://127.0.0.1:8000/api/descargar`;

const LibroIndv = ({ userGlobal }) => {

  const navigate = useNavigate();
  const params = useParams();
  const [libro, setLibro] = useState({});
  let suma = 0;
  const [media, setMedia] = useState(0);
  const [totalVal, setTotalVal] = useState(0);
  const [comments, setComments] = useState([]);

  const getComments = async () => {
    try {
      const url = `http://localhost:8000/api/libros/${params.id}`;
      let respuesta = await fetch(url, {
        headers: {
          'Accept': 'application/json',
        },
      });
      let data = await respuesta.json();
      //console.log(data);
      setLibro(data);

    } catch (e) {
      console.log(e);
    }
  }

  const fetchPost = async (url, objectToUpload) => {
    //console.log(JSON.stringify(objectToUpload));
    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(objectToUpload)
      });
      //console.log(response);
      const file = await response.blob();      
      //console.log(file);
      //saveAs(file, "libro.epub"); //este le cambia el nombre a lo que pone en el segundo parámetro. A lo mejor se podría tomar del estado?
      saveAs(file);
    } catch (error) {
      console.log(error);
    }
  };

  const handleDescarga = (e) => {
    e.preventDefault();
    if (!document.getElementById("aceptarTerminos").checked) {
      alert("Debe aceptar los términos");
      return;
    }
    const data = {
      url: libro.url,
      tituloLibro: libro.titulo,
      //url: "../public/books/A/A-ciegas-Claudio-Magris-6216578286703.epub",
      idUser: userGlobal.id,
      idLibro: libro.id,
    }
    //console.log(data);
    fetchPost(descargaUrl, data);
  }

  const handleSubirVal = () => {

  }

  const handleSubirComment = () => {

  }

  const handleVolver = () => {
    navigate('/');
  }

  const calculoMedia = () => {

    libro.valoraciones.forEach(val => {
      suma += val.puntuacion;
    });
    let valor = suma / totalVal;
    setMedia(valor.toFixed(1));
  }

  useEffect(() => {
    getComments();

  }, []);

  useEffect(() => {
    if ("id" in libro) {
      setTotalVal(libro.valoraciones?.length);
      setComments(libro.comentarios);
    }
  }, [libro]);

  useEffect(() => {
    if (totalVal > 0) {
      calculoMedia();
    }

  }, [totalVal]);


  return (
    <section id="libroIndv">

      <section className="datosLibro">

        <div className="img">
          <img src="/img/libro.png" alt={libro.titulo} />
        </div>

        <div className="tituloLibro">
          <h4>{libro.titulo}</h4>
          <p>{libro.autor}</p>

          <p>Puntuación: {media} de 5 <span className="little">({totalVal} valoraciones)</span></p>

          <form onSubmit={handleSubirVal} id="formSubirVal">
            <span className="mr-3">Valorarión: </span>
            <select name="val" className="mr-3 custom-select">
              <option value="val1">1</option>
              <option value="val2">2</option>
              <option value="val3">3</option>
              <option value="val4">4</option>
              <option value="val5">5</option>
            </select> 
            <button className="btn">Subir</button>    
          </form>

          {
            userGlobal ?
              <form id="formDescargar" onSubmit={handleDescarga}>
                <div className="form-group">
                  <input type="checkbox" name="aceptar" id="aceptarTerminos" />
                  <label htmlFor="aceptarTerminos">Acepto los términos de descarga</label>
                </div>

                <button className="btn" name="descargar">Descargar</button>
              </form> :
              null
          }

        </div>

      </section>

      <section className="commentsAndStarts">

        <form onSubmit={handleSubirComment} id="formSubirComment">
          <h4>Comentar:</h4>
          <textarea></textarea>
          <button className="btn">Subir</button>
        </form>

        <section className="comments">
          <h4>Comentarios</h4>
          <table>
            <tbody>
              {comments.map(comentario =>
                <tr key={comentario.id}>
                  <td className="bold">{comentario.autor.username}:</td>
                  <td>{comentario.comentario}</td>
                </tr>
              )}
            </tbody>
          </table>
        </section>

      </section>

      <button onClick={handleVolver} className="btn btn-primary" id="btnVolver">Volver ↩</button>

    </section>
  )
}

export default LibroIndv