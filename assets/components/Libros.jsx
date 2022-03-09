import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import Buscador from './Buscador';

const url = `http://127.0.0.1:8000/api/libros`;

const Libros = ({userGlobal}) => {
    const [libros, setLibros] = useState([]);
    const [paginationInfo, setPaginationInfo] = useState({})

    const getInfo = async (url) => {
        try {            
            let respuesta = await fetch(url);
            let data = await respuesta.json();
            console.log(data);
            setLibros(data["hydra:member"]);
            setPaginationInfo(data["hydra:view"]);
        } catch (error) {
            console.log(error);
        }
    };

    const handleNext = () => {
        getInfo(`http://127.0.0.1:8000${paginationInfo["hydra:next"]}`);
    }

    const handlePrevious = () => {
        getInfo(`http://127.0.0.1:8000${paginationInfo["hydra:previous"]}`);
    }

    useEffect(() => {
        getInfo(url);
    }, []);

    return (
        <>
            <section className="librosYbuscador">

            <Buscador setLibros={setLibros}/> 

            {userGlobal?.username ? 
                <section className='librosSinLogin'>
                    {libros.map((libro) => (
                    <Link to={'libro/'+libro.id.toString()} key={libro.id}>
                        <div className="libroSinLoguin" key={libro.id}>
                            <h4>{libro.titulo}</h4>
                            <p>{libro.autor}</p>
                        </div>
                    </Link>
                    ))}
                </section>
            : 
                <section className='librosConLoguin'>
                    {libros.map((libro) => (
                    <Link to={'libro/'+libro.id.toString()} key={libro.id}>
                        <div className="libroConLoguin" >
                            <h4>{libro.titulo}</h4>
                            <p>{libro.autor}</p>
                        </div>
                    </Link>
                    ))}
                </section>
            }
            {
                paginationInfo["hydra:first"] === paginationInfo["@id"] ?
                null :
                <button onClick={handlePrevious} className="btn">Anterior</button>
            }
            {
                paginationInfo["@id"] === paginationInfo["hydra:last"] ?
                null :
                <button onClick={handleNext} className="btn">Siguiente</button>
            }


            </section>
        </>
    )
}

export default Libros