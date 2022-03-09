import React, { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom'

const descargaUrl = `http://127.0.0.1:8000/api/descargar`;

const LibroIndv = ({ userGlobal }) => {

  const navigate = useNavigate();
  const params = useParams();
  const [libro, setLibro] = useState({});
  let suma = 0;
  const [media, setMedia] = useState(0);
  const [totalVal, setTotalVal] = useState(0);

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
    if("id" in libro)
      setTotalVal(libro.valoraciones?.length);
  }, [libro]);
  
  useEffect(()=>{
    if(totalVal > 0){
      calculoMedia();
    }
    
  },[totalVal]);
  

  return (
    <section id="libroIndv">

      <section className="datosLibro">

        <div className="img">
          <img src="/img/libro.png" alt={libro.titulo}/>
        </div>

        <div className="tituloLibro">
          <h4>{libro.titulo}</h4>
          <p>{libro.autor}</p>

          <p>Puntuación: {media} de 5 <span className="little">({totalVal} valoraciones)</span></p>

          <form id="formDescargar" onSubmit={handleDescarga}>
            <div className="form-group">
              <input type="checkbox" name="aceptar" id="aceptarTerminos"/>
              <label htmlFor="aceptarTerminos">Acepto los términos de descarga</label>
            </div>

            <button className="btn" name="descargar">Descargar</button>
          </form>

        </div>

      </section>

      <section className="commentsAndStarts">

        <span>Valoración: </span>
        <form onSubmit={handleSubirVal} id="formSubirVal">
          <select name="val">
            <option value="val1">1</option>
            <option value="val2">2</option>
            <option value="val3">3</option>
            <option value="val4">4</option>
            <option value="val5">5</option>
          </select>
        </form>

        <form onSubmit={handleSubirComment} id="formSubirComment">
          <p>Subir comentario:</p>
          <textarea></textarea>
        </form>
      </section>

      <button onClick={handleVolver} className="btn btn-primary" id="btnVolver">Volver ↩</button>

    </section>
  )
}

export default LibroIndv