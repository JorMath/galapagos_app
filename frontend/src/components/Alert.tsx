interface AlertProps {
  variant?: 'success' | 'error' | 'info';
  message: string;
  className?: string;
}

/**
 * Alert component for success, error, info messages
 */
const Alert = ({ variant = 'info', message, className = '' }: AlertProps) => {
  const variantClasses = {
    success: 'bg-green-100 text-green-800 border-green-200',
    error: 'bg-red-100 text-red-800 border-red-200',
    info: 'bg-blue-100 text-blue-800 border-blue-200',
  };

  return (
    <div className={`p-4 rounded-lg border ${variantClasses[variant]} ${className}`}>
      <p className="text-sm">{message}</p>
    </div>
  );
};

export default Alert;