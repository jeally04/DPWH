-- DPWH Bohol 1st District Engineering Office
-- ICT Staff Job Sheet System - Database Schema
-- Run this in phpMyAdmin or MySQL CLI to set up the database

CREATE DATABASE IF NOT EXISTS job_sheet_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE job_sheet_db;

-- Pending forms submitted by end-users (intake queue)
CREATE TABLE IF NOT EXISTS pending_forms (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    full_name     VARCHAR(255) NOT NULL,
    section_division VARCHAR(255) NOT NULL,
    description   TEXT NOT NULL,
    date_of_filing DATE NOT NULL,
    date_received  DATETIME NOT NULL,
    contact_no    VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Completed job sheets (IT support records)
CREATE TABLE IF NOT EXISTS job_sheet (
    id                       INT AUTO_INCREMENT PRIMARY KEY,
    full_name                VARCHAR(255)  NOT NULL,
    section_division         VARCHAR(255)  NOT NULL,
    description              TEXT          NOT NULL,
    date_of_filing           VARCHAR(50)   NOT NULL,
    contact_no               VARCHAR(50)   NOT NULL,
    type                     VARCHAR(50)   NOT NULL,        -- Hardware / Software
    status                   VARCHAR(50)   NOT NULL,        -- Closed / Open
    incident_type            VARCHAR(100)  NOT NULL DEFAULT 'Service Request',
    -- Hardware fields
    hardware_type            VARCHAR(100)  DEFAULT 'N/A',
    serial_number            VARCHAR(100)  DEFAULT 'N/A',
    brand_model              VARCHAR(100)  DEFAULT 'N/A',
    computer_name            VARCHAR(100)  DEFAULT 'N/A',
    -- Software fields
    application_description  TEXT          DEFAULT NULL,
    version                  VARCHAR(100)  DEFAULT 'N/A',
    connectivity_description TEXT          DEFAULT NULL,
    user_account_description TEXT          DEFAULT NULL,
    -- Resolution
    assessment               TEXT          DEFAULT NULL,
    actions_taken            TEXT          DEFAULT NULL,
    -- Filing info
    mode_of_filing           VARCHAR(50)   NOT NULL,        -- Walk-in / Telephone Call / Email
    fulfilled_by             VARCHAR(255)  NOT NULL,
    date_received            VARCHAR(50)   NOT NULL,
    date_completed           VARCHAR(50)   NOT NULL,
    reviewed_by              VARCHAR(255)  NOT NULL,
    -- Client evaluation (used in print view)
    addressed                VARCHAR(10)   DEFAULT NULL,    -- Yes / No
    satisfied                VARCHAR(50)   DEFAULT NULL,    -- Very Satisfied / Satisfied / Not Satisfied
    effective                VARCHAR(50)   DEFAULT NULL,
    comments                 TEXT          DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
