import React, { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom'

const descargaUrl = `http://127.0.0.1:8000/api/descargar`;

const LibroIndv = ({ userGlobal }) => {

  const navigate = useNavigate();
  const params = useParams();
  const [libro, setLibro] = useState({});

  const getComments = async () => {
    try{
        const url = `http://localhost:8000/api/libros/${params.id}`;
        let respuesta = await fetch(url, {
            headers: {
                'Accept': 'application/json',
            },
        });
        let data = await respuesta.json();
        //console.log(data);
        setLibro(data);

        }catch(e){
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
      const data = await response.json();
      console.log(data);

    } catch (error) {
      console.log(error);
    }
  };

  const handleDescarga = (e) => {
    e.preventDefault();

    const data = {
      url: libro.url,
      idUser: userGlobal.id,
      libroId: libro.id,
    }
    //console.log(data);
    fetchPost(descargaUrl, data);
  }

  const handleVolver = () => {
    navigate('/');
  }

  useEffect(() => {
    getComments();
  }, []);
  

  return (
    <section id="libroIndv">

      <section className="datosLibro">
        <div className="img">
          <img src="/img/libro.png" alt={libro.titulo}/>
        </div>
        <div className="tituloLibro">
          <h4>{libro.titulo}</h4>
          <p>{libro.autor}</p>
        </div>

        <form>
          <label htmlFor="aceptarTerminos">Acepto los términos de descarga</label>
          <input type="checkbox" name="aceptar" id="aceptarTerminos"/>
          <input type="button" value="Descargar" name="descargar" onClick={handleDescarga}/>
        </form>
      </section>

      <section className="commentsAndStarts">

      </section>


      <button onClick={handleVolver} className="btn btn-primary">Volver ↩</button>
    </section>
  )
}

export default LibroIndv