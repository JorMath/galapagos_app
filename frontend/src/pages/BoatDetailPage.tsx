import { useParams, Link } from 'react-router-dom';
import { useBoat } from '../hooks/useBoats';
import Card from '../components/Card';
import LoadingSpinner from '../components/LoadingSpinner';
import Alert from '../components/Alert';

/**
 * BoatDetailPage - displays detailed boat information
 */
const BoatDetailPage = () => {
  const { id } = useParams();
  const boatId = id ? parseInt(id, 10) : undefined;
  const { boat, loading, error } = useBoat(boatId || 0);

  if (loading) {
    return (
      <div className="py-12">
        <LoadingSpinner size="large" />
      </div>
    );
  }

  if (error) {
    return (
      <div className="py-8">
        <Alert variant="error" message={error} />
        <div className="mt-4">
          <Link to="/" className="text-primary-500 hover:text-primary-600">
            ← Volver a los barcos
          </Link>
        </div>
      </div>
    );
  }

  if (!boat) {
    return (
      <div className="py-8">
        <Alert variant="error" message="Barco no encontrado" />
        <div className="mt-4">
          <Link to="/" className="text-primary-500 hover:text-primary-600">
            ← Volver a los barcos
          </Link>
        </div>
      </div>
    );
  }

  const imageUrl = boat.imagen_url || boat.imagen
    ? (boat.imagen_url || `/storage/${boat.imagen}`)
    : null;

  return (
    <div className="py-8">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <Link
          to="/"
          className="btn-secondary mb-6"
        >
          Volver a los barcos
        </Link>

        {imageUrl && (
          <div className="mb-6 overflow-hidden rounded-card">
            <img
              src={imageUrl}
              alt={boat.nombre}
              className="w-full h-64 md:h-96 object-cover"
            />
          </div>
        )}

        <Card>
          <h1 className="text-3xl font-display font-medium text-gray-900 mb-4">
            {boat.nombre}
          </h1>

          {boat.capacidad_pasajeros && (
            <div className="mb-4">
              <span className="text-sm text-gray-500">Capacidad de pasajeros: </span>
              <span className="font-medium text-gray-900">
                {boat.capacidad_pasajeros} pasajeros
              </span>
            </div>
          )}

          {boat.descripcion && (
            <div className="mt-4">
              <h2 className="text-lg font-medium text-gray-900 mb-2">
                Descripción
              </h2>
              <p className="text-gray-600">{boat.descripcion}</p>
            </div>
          )}

          <div className="mt-6 pt-6 border-t border-border">
            <Link
              to="/itineraries"
              className="btn-primary inline-block"
            >
              Ver itinerarios de este barco
            </Link>
          </div>
        </Card>
      </div>
    </div>
  );
};

export default BoatDetailPage;