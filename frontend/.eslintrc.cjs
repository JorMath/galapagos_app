module.exports = {
  root: true,
  env: {
    browser: true,
    es2021: true,
    node: true,
  },
  extends: [
    'airbnb',
    'prettier',
  ],
  parser: '@typescript-eslint/parser',
  parserOptions: {
    ecmaFeatures: {
      jsx: true,
    },
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  plugins: ['react', 'jsx-a11y', '@typescript-eslint'],
  settings: {
    react: {
      version: 'detect',
    },
    'import/resolver': {
      node: {
        extensions: ['.js', '.jsx', '.ts', '.tsx'],
      },
    },
  },
  rules: {
    // Allow JSX in .tsx files
    'react/jsx-filename-extension': [1, { extensions: ['.jsx', '.tsx'] }],
    // React 17+ does not require React import in every file
    'react/react-in-jsx-scope': 'off',
    // TypeScript replaces prop-types
    'react/prop-types': 'off',
    'react/require-default-props': 'off',
    // Allow arrow functions for components
    'react/function-component-definition': 'off',
    // Allow console for now
    'no-console': 'off',
    // Allow _ prefix for unused vars
    'no-unused-vars': ['warn', { argsIgnorePattern: '^_' }],
    // Allow spread props
    'react/jsx-props-no-spreading': 'off',
    // Import extensions
    'import/extensions': ['error', 'ignorePackages', {
      js: 'never',
      mjs: 'never',
      jsx: 'never',
      ts: 'never',
      tsx: 'never',
    }],
    // Allow use before define for types
    'no-use-before-define': ['error', { functions: false, classes: false, variables: false }],
    // Label accessibility
    'jsx-a11y/label-has-associated-control': ['error', { labelComponents: [], controlComponents: [] }],
    // Allow array index as key when no unique ID available
    'react/no-array-index-key': 'off',
  },
};