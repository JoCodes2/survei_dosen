// public/controllers/survei.service.js

class SurveiService {
    constructor() {
        this.apiBaseUrl = `${appUrl}/survei`;
    }

    ajaxRequest(url, method, data = null, isJson = false) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data: isJson ? JSON.stringify(data) : data,
                processData: isJson ? false : false,
                contentType: isJson ? 'application/json' : false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    resolve(response);
                },
                error: (xhr) => {
                    reject(xhr);
                }
            });
        });
    }
    async getInitialData() {
        try {
            const [resProdi, resSemester] = await Promise.all([
                this.ajaxRequest(`${this.apiBaseUrl}/programstudi/`, 'GET'),
                this.ajaxRequest(`${this.apiBaseUrl}/semester/`, 'GET')
            ]);
            return { prodi: resProdi.data || [], semester: resSemester.data || [] };
        } catch (error) {
            console.error('Error fetching initial data:', error);
            return { prodi: [], semester: [] };
        }
    }

    async getKriteria() {
        try {
            const response = await this.ajaxRequest(`${this.apiBaseUrl}/kriteria/`, 'GET');
            return response.data || [];
        } catch (error) {
            console.error('Error fetching kriteria:', error);
            return [];
        }
    }

    async getDosenByProdiSemester(prodiId, semesterId) {
        try {
            const response = await this.ajaxRequest(`${this.apiBaseUrl}/jadwal/`, 'GET');
            const filteredData = response.data.filter(item =>
                item.program_studi_id === prodiId &&
                item.semester_id === semesterId
            );
            return filteredData || [];
        } catch (error) {
            console.error('Error fetching dosen:', error);
            return [];
        }
    }
    async submitPenilaianJSON(payload) {
        const submitButton = $('#btnKirim');
        const originalText = submitButton.html();

        try {
            submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengirim...');

            const responseData = await this.ajaxRequest(
                `${this.apiBaseUrl}/penilaian/create`,
                'POST',
                payload,
                true
            );

            return responseData;

        } catch (error) {
            submitButton.attr('disabled', false).html(originalText);

            if (error.status === 422) {
                return error.responseJSON;
            }

            throw error;
        }
    }
}

export default SurveiService;
