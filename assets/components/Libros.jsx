import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import Buscador from './Buscador';

const Libros = ({userGlobal}) => {
    const [libros, setLibros] = useState([]);

    const getInfo = async () => {
        try {
            const url = `http://127.0.0.1:8000/api/libros`;
            let respuesta = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                },
            });
            let data = await respuesta.json();
            //console.log(data);
            setLibros(data);
        } catch (error) {
            console.log(error);
        }
    };

    useEffect(() => {
        getInfo();
    }, []);

    return (
        <>
            <section className="librosYbuscador">

            <Buscador /> 

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

            </section>
        </>
    )
}

export default Libros