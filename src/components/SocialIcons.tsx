
import React from 'react';

export interface SocialIconProps {
  className?: string;
}

export const Facebook: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none" stroke="#4267B2" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
  </svg>
);

export const Instagram: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none" stroke="url(#instagram-gradient)" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <defs>
      <linearGradient id="instagram-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stopColor="#FCAF45" />
        <stop offset="25%" stopColor="#E1306C" />
        <stop offset="50%" stopColor="#C13584" />
        <stop offset="75%" stopColor="#7638FA" />
        <stop offset="100%" stopColor="#5851DB" />
      </linearGradient>
    </defs>
    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
  </svg>
);

export const Twitter: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none" stroke="#1DA1F2" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
  </svg>
);

export const Youtube: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none" stroke="#FF0000" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
  </svg>
);

export const Twitch: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none" stroke="#9146FF" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M21 2H3v16h5v4l4-4h5l4-4V2zm-10 9V7m5 4V7"></path>
  </svg>
);

export const Linkedin: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none" stroke="#0A66C2" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
    <rect x="2" y="9" width="4" height="12"></rect>
    <circle cx="4" cy="4" r="2"></circle>
  </svg>
);

export const TiktokLogo: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none">
    <path d="M19.321 5.562c-1.247-.644-2.121-1.848-2.315-3.245h-3.006v13.066c0 1.763-1.25 3.177-2.947 3.177-1.697 0-2.946-1.414-2.946-3.177 0-1.763 1.25-3.177 2.946-3.177.326 0 .64.06.943.154V9.392c-.302-.05-.614-.082-.943-.082-3.283 0-5.947 2.714-5.947 6.06 0 3.344 2.664 6.059 5.947 6.059 3.282 0 5.947-2.715 5.947-6.06V8.8c1.228.847 2.722 1.352 4.34 1.352V7.175c-.035 0-.072.005-.107.005-.8 0-1.55-.372-2.035-.983-.41-.516-.668-1.162-.668-1.866 0-.039 0-.077.002-.116" 
      strokeWidth="2" stroke="black" strokeLinecap="round" strokeLinejoin="round"
      fill="url(#tiktok-gradient)"></path>
    <defs>
      <linearGradient id="tiktok-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stopColor="#25F4EE" />
        <stop offset="50%" stopColor="#000000" />
        <stop offset="100%" stopColor="#FE2C55" />
      </linearGradient>
    </defs>
  </svg>
);

export const DribbbleLogo: React.FC<SocialIconProps> = ({ className }) => (
  <svg xmlns="http://www.w3.org/2000/svg" className={className} viewBox="0 0 24 24" fill="none" stroke="#EA4C89" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
    <circle cx="12" cy="12" r="10"></circle>
    <path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"></path>
  </svg>
);
