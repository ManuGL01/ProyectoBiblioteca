import React , {useState,useEffect} from 'react';

const Main = () => {
    const [libros, setLibros] = useState([]);
    useEffect(() => {
        getInfo();
    },[])
    const getInfo = async () => {
        try{
        const url = `/api/libros`;
        let respuesta = await fetch(url);
        let data = await respuesta.json();
        setLibros(data.map(libro => libros.push(libro)));
        } catch{
            console.log(error);
        }
    };
  return (
    <>
    <section>
        {libros.map((libro) =>(
            <div>
                <h4>Titulo - {libro.titulo}</h4>
                <p>Autor - {libro.autor}</p>
            </div>
        ))}
    </section>
    </>
  )
}

export default Main