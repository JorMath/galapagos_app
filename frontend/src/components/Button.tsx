import type { ReactNode, ButtonHTMLAttributes } from 'react';

interface ButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: 'primary' | 'secondary' | 'danger';
  type?: 'submit' | 'button';
  disabled?: boolean;
  children: ReactNode;
  className?: string;
}

/**
 * Button component with variants: primary, secondary, danger
 */
const Button = ({
  variant = 'primary',
  type = 'button',
  disabled = false,
  children,
  className = '',
  ...props
}: ButtonProps) => {
  const variantClasses = {
    primary: 'btn-primary',
    secondary: 'btn-secondary',
    danger: 'btn-danger',
  };

  const classes = `${variantClasses[variant]} ${className}`;

  return (
    <button
      type={type === 'submit' ? 'submit' : 'button'}
      disabled={disabled}
      className={classes}
      {...props}
    >
      {children}
    </button>
  );
};

export default Button;